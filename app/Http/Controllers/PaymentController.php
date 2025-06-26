<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Http\Controllers\Controller;
use App\Models\order_detail;
use Carbon\Carbon;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PaymentController extends Controller
{
    public function show($encrypted_id){
        $customer = auth('customer')->user();

        $order_id = Crypt::decrypt($encrypted_id);

        $order = order::where('order_id', $order_id)->where('customer_id', $customer->customer_id)
        ->with('order_detail.product')->firstOrfail();
        
        $orders = $order->order_detail;
        
        $expiredTime = $order->created_at->addHours(24);
        $remainingSeconds = $expiredTime->timestamp - Carbon::now()->timestamp;
        
        if ($remainingSeconds <= 0) {
            return redirect()->route('checkout')->with('error', 'Waktu pembayaran sudah habis. Order telah dihapus.');
        }

        $order->enc_id = Crypt::encrypt($order->order_id);
        
        $orders->transform(function ($detail){
            $detail->enc_id = Crypt::encrypt($detail->order_d_id);
            unset($detail->order_d_id);
            return $detail;
        });

        return view('logged-in.payment', [
            'title' => 'Payment',
            'order' => $order,
            'remainingSeconds' => $remainingSeconds,
            'expiredTime' => $expiredTime->format('Y-m-d H:i:s'),
            'order_items' => $orders
        ]);
    }

    public function confirmPayment(Request $request, $encrypted_id){
         try {
            $order_id = Crypt::decrypt($encrypted_id);
            $order = Order::findOrFail($order_id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('cart')->with('error', 'ID Order tidak valid.');
        }

         $request->validate([
            'payment_method' => 'required|in:transfer,cod',
            // Bukti pembayaran wajib jika metodenya transfer
            'payment_proof' => 'required_if:payment_method,transfer|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        // 2. Proses berdasarkan Metode Pembayaran
        if ($request->payment_method === 'transfer') {
            // Handle upload ke Cloudinary
            $cloudinary = new Cloudinary(env('CLOUDINARY_URL'));
            $result = $cloudinary->uploadApi()->upload(
                $request->file('payment_proof')->getRealPath(),
                ['folder' => 'payment_proofs']
            );

            
            $order->payment_proof_url = $result['secure_url'];
            $order->status_pesanan = 'Sedang Diverifikasi';
            $order->payment_method = 'Transfer';

        } else { 
            $order->status_pesanan = 'Sedang Diverifikasi'; 
            $order->payment_method = 'COD';
        }

        // 3. Simpan perubahan dan redirect
        $order->save();

        // Redirect ke halaman status pesanan (buat route dan view baru jika perlu)
        return response()->json([
            'success' => true,
            'message' => 'Pembayaran Anda akan segera kami verifikasi.',
            'redirect_url' => route('order.status', ['encrypted_id' => $encrypted_id])
        ]);
    }

    public function getRecipt($encrypted_id){
        try {
            $order_id = Crypt::decrypt($encrypted_id);
        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', 'ID Pesanan tidak valid.');
        }

        $order = order::with('order_detail.product')->findOrFail($order_id);

        $orderData = [
            'id' => $order->order_id,
            'status' => $order->status_pesanan,
            'orderDate' => Carbon::parse($order->created_at)->translatedFormat('d F Y'),
            'paymentMethod' => $order->payment_method,
            'deliveryDate' => Carbon::parse($order->tanggal_kirim)->translatedFormat('d F Y'),
            'deliveryTime' => Carbon::parse($order->waktu)->format('H:i') . ' WIB',
            'deliveryAddress' => $order->alamat,
            'notes' => $order->catatan,
            // MODIFIKASI LOGIKA DI BAWAH INI
            'items' => $order->order_detail->map(function ($detail) use ($order) { // <-- TAMBAHKAN 'use ($order)'
                return [
                    'id' => $detail->order_d_id,
                    'name' => $detail->product->nama,
                    'quantity' => (int) $order->jumlah, // <-- AMBIL DARI $order->jumlah
                    'price' => (int) $detail->harga_now,
                ];
            })->toArray(),
        ];

        return view('logged-in.recipt', ['title' => 'Struk Pembayaran', 'orderData' => $orderData]);
    }
}
