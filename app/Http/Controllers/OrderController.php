<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\product;
use App\Models\cart_detail;
use App\Models\cart;
use App\Models\order_detail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function page(){
        $products = product::paginate(8);
        return view('logged-in.order', ['title' => 'E-Catering'], compact('products'));
    }

    public function getdate(){
        $bookedDates = Order::pluck('tanggal_kirim')
                            ->map(function($date) {
                                return is_string($date) ? $date : $date->format('Y-m-d');
                            })
                            ->unique()
                            ->values()
                            ->toArray();

        return response()->json([
            'success' => true,
            'booked_dates' => $bookedDates
        ]);
    }


    public function getorder(Request $request){
        $customer = auth('customer')->user();

        $orders = order::where('customer_id', $customer->customer_id)->where('status_pesanan', 'Belum Dibayar')->orderBy('created_at')->get();

        $orders->transform(function($order){
            $order->encrypted_id = Crypt::encrypt($order->order_id);
            return $order;
        });
        unset($orders->order_id);

        return response()->json([
            'success' => true,
            'orders' => $orders
        ]);
    }
    
    public function mkorder(Request $request){
        $customer = auth('customer')->user();
        
        $request->validate([
        'tanggal_kirim' => 'required|date|after:today',
        'alamat' => 'required|string|max:500',
        'waktu' => 'required|string',
        'jumlah' => 'required|integer|min:50',
        'catatan' => 'nullable|string|max:500',
        'checkoutt' => 'boolean',
        ],[
            'jumlah.min' => 'Paket Katering Kurang Dari 50',
        ]);


        if($request->checkoutt){
            try{
                DB::beginTransaction();

                $order = order::create([
                    'customer_id' => $customer->customer_id,
                    'tanggal_kirim' => $request->tanggal_kirim,
                    'waktu' => $request->waktu,
                    'jumlah' => $request->jumlah,
                    'alamat' => $request->alamat,
                    'catatan' => $request->catatan,
                ]);

                $orderstatus = order::where('customer_id', $order->customer_id)
                                ->where('created_at', $order->created_at) // created_at dari instance PHP
                                ->orderBy('created_at', 'desc') 
                                ->first();
        
                if (!$orderstatus || !$orderstatus->order_id) {
                    DB::rollback();
                    return response()->json([
                        'success'=> false,
                        'message' => 'Gagal generate order ID',
                    ], 500);
                }
                $detailResult = $this->mkdorder($customer, $orderstatus);

                // Periksa hasil dari mkdorder jika ia mengembalikan status
                if (isset($detailResult['success']) && !$detailResult['success']) {
                    // Jika mkdorder gagal (misalnya keranjang kosong dan itu dianggap error)
                    DB::rollback(); // Rollback transaksi utama
                    return response()->json([
                        'success' => false,
                        'message' => $detailResult['message'] ?? 'Gagal memproses detail pesanan.',
                    ], $detailResult['status_code'] ?? 400);
                }


                DB::commit();

                $encrypted_id = Crypt::encrypt($orderstatus->order_id);

                return response()->json([
                    'success'=> true,
                    'message' => 'Pesanan Berhasil Dibuat',
                    'redirect' => '/payment/'. $encrypted_id,
                ]);

                return redirect()->route('payment', $encrypted_id);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'success'=> false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ], 500);
            }
        }
        
        return response()->json([
            'success'=> false,
            'message' => 'Pesanan Gagal Dibuat',
        ]);
    }
    
    public function rmorder(Request $request){
        
    }
    
    public function mkdorder(Authenticatable $customer, order $order){
        $cartitems = cart_detail::whereHas('cart', function($query) use ($customer){
            $query->where('customer_id', $customer->customer_id);
        })->with('product')->get();
        
        if ($cartitems->isEmpty()) {
            // Jika order wajib punya detail, kembalikan status error
            // Ini akan ditangkap oleh mkorder dan transaksi di-rollback.
            return [
                'success' => false, // Atau true jika order tanpa detail diizinkan
                'message' => 'Keranjang kosong, tidak ada detail pesanan yang dibuat.',
                'status_code' => 400 // Atau 200 jika ini bukan error
            ];
        }

        try {
            foreach ($cartitems as $cartitem){
                order_detail::create([
                'order_id' => $order->order_id, // order_id sudah pasti valid di sini
                'product_id' => $cartitem->product->product_id,
                'harga_now' => $cartitem->product->harga
                ]);
            }

            // Hapus item dari keranjang setelah berhasil dipindahkan ke order_detail
            $cartitems->each->delete();

            return [
                'success'=> true,
                'message' => 'Detail pesanan berhasil diproses.'
            ];

        } catch (\Exception $e) {
            // Jika terjadi error di sini, exception akan naik ke catch block di mkorder,
            // dan transaksi akan di-rollback.
            // Atau, kita bisa return status error spesifik.
            return [
                'success' => false,
                'message' => 'Gagal memproses detail pesanan: ' . $e->getMessage(),
                'status_code' => 500
            ];
        }
    }
}
