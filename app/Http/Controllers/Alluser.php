<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\order_detail;
use App\Models\report;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Alluser extends Controller
{
/*
        {{-- Profile Controller --}}
*/  
    public function userprofile(){
        $orders = null;

        if(auth('customer')->check()){
            $customer = auth('customer')->user();
            
            $orders = order::with(['orderDetails.product', 'customer'])
                ->where('customer_id', $customer->customer_id)
                ->where('status_pesanan', 'Selesai')
                ->orderBy('tanggal_kirim', 'asc')
                ->get();
        }

        return view('logged-in.profile', ['title' => 'Profile', 'orders' => $orders]);            
    }

    public function changePW(Request $request){
        $user = null;
        
        if(auth('customer')->check()) {
            $user = auth('customer')->user();
        } elseif(auth('admin')->check()) {
            $user = auth('admin')->user();
        } elseif(auth('owner')->check()) {
            $user = auth('owner')->user();
        }
        
        if (!$user) {
            return back()->with('error', 'User tidak terautentikasi');
        }

        $request->validate([
        'old-pass' => 'required|string',
        'new-pass' => 'required|string|min:8|confirmed', // 'confirmed' akan cek new-pass_confirmation
        'new-pass_confirmation' => 'required|string|min:8',
    ], [
        'new-pass.confirmed' => 'Konfirmasi password tidak sesuai.',
        'new-pass.min' => 'Password baru harus minimal 8 karakter.',
        'new-pass_confirmation.min' => 'Konfrimasi password baru harus minimal 8 karakter.',
        'new-pass_confirmation.required' => 'Konfirmasi password wajib diisi.',
    ]);

        if (!Hash::check($request->input('old-pass'), $user->password)) {
        return back()->with('error', 'Password lama tidak sesuai');
        }

        $user->password = Hash::make($request->input('new-pass'));
        $user->save();
    
        return back()->with('success', 'Password berhasil diubah!');
    }

    public function changeProfile(Request $request){
        $user = null;
        
        if(auth('customer')->check()) {
            $user = auth('customer')->user();
        } elseif(auth('admin')->check()) {
            $user = auth('admin')->user();
        } elseif(auth('owner')->check()) {
            $user = auth('owner')->user();
        }
        
        if (!$user) {
            return back()->with('error', 'User tidak terautentikasi');
        }

            $rules =[
            'name' => 'required|string',
            'email' => 'required|string',
            'no_hp' => 'required|string|max:15',
        ];

        $request->validate($rules);

    try {
        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        
        $user->save();
        return back()->with('success', 'Profile berhasil diupdate!');
    }

    catch (\Exception $e) {
        return back()->with('error', 'Gagal update profile: ' . $e->getMessage());
    }
}

/*
        {{-- ADMIN CONTROLLER --}}
*/
    public function adminhome(){
        return view('admin.home', ['title' => 'Home Admin']);
    }

    // API untuk Pesanan
    public function getOrders()
    {
        $orders = order::with('customer')->whereIn('status_pesanan', ['Dibatalkan','Sudah Diverifikasi', 'Sedang Dibuat', 'Dalam Pengiriman'])->get();

        
        $total_verifed = 0;
        
        foreach($orders as $verifedOrder){
            
            $verifedOrder->waktu = Carbon::parse($verifedOrder->waktu)->format('H:i');
            $verifedTotal = 0;
            $verifedDetail = order_detail::where('order_id', $verifedOrder->order_id)->get();
            
            foreach($verifedDetail as $detail){
                $verifedTotal += $detail->harga_now * $verifedOrder->jumlah;
            }
            $verifedOrder->total = $verifedTotal;
            $total_verifed += $verifedTotal;

        }
        $orders->transform(function ($order){
            $order->enc_id = Crypt::encrypt($order->order_id);
            unset($orders->order_id);
            return $order;
        });
        return response()->json($orders);
    }
    public function getOrder($orderId)
    {
        $order_id = Crypt::decrypt($orderId);   

        $order = order::where('order_id', $order_id)->firstOrfail();

        $order->waktu = Carbon::parse($order->waktu)->format('H:i');

        $total = 0;

            $ordertotal = 0;
            
            $orderdetail = order_detail::where('order_id', $order->order_id)->get();
            
            foreach($orderdetail as $detail){
                $ordertotal += $detail->harga_now * $order->jumlah;
            }
            
            $order->total = $ordertotal;
            
            $total += $ordertotal;
        return response()->json($order);
    }

    public function updateOrder(Request $request, $orderId)
    {
        try {
            $order_id = Crypt::decrypt($orderId);
            $order = order::where('order_id', $order_id)->firstOrFail();
            $admin = auth('admin')->user();

        // Validasi input JSON
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:Dibatalkan,Belum Dibayar,Sedang Diverifikasi,Sudah Diverifikasi,Sedang Dibuat,Dalam Pengiriman,Selesai',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update status dari JSON request
        $order->status_pesanan = $request->status;
        $order->admin_id = $admin->admin_id;
        $order->save();

        return response()->json([
            'message' => 'Status Pesanan Berhasil Diperbarui!', 
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Gagal update status pesanan: ' . $e->getMessage()
        ], 500);
    }
    }


    // API untuk Reservasi
    public function getReservations()
    {
        $orders = order::with('customer')->whereIn('status_pesanan', [
            'Belum Dibayar', 'Sedang Diverifikasi',
        ])->get();

        
        $total = 0;
        
        foreach($orders as $order){

            $ordertotal = 0;
            
            $orderdetail = order_detail::where('order_id', $order->order_id)->get();
            
            foreach($orderdetail as $detail){
                $ordertotal += $detail->harga_now * $order->jumlah;
            }
            
            $order->total = $ordertotal;
            $total += $ordertotal;
        }
        $orders->transform(function ($order){
            $order->enc_id = Crypt::encrypt($order->order_id);
            unset($orders->order_id);
            return $order;
        });
        return response()->json($orders);
    }

    public function getReservation($enc_id){

        $order_id = Crypt::decrypt($enc_id);

        $order = order::where('order_id', $order_id)->firstOrfail();
        
        $order->waktu = Carbon::parse($order->waktu)->format('H:i');

        unset($orders->order_id);
    
        $total = 0;

            $ordertotal = 0;
            
            $orderdetail = order_detail::where('order_id', $order->order_id)->get();
            
            foreach($orderdetail as $detail){
                $ordertotal += $detail->harga_now * $order->jumlah;
            }
            
            $order->total = $ordertotal;
            
            $total += $ordertotal;
        return response()->json($order);
    }

   

    public function updateReservation($reservasiId)
    {
        $admin = auth('admin')->user();
        $order_id = Crypt::decrypt($reservasiId);
        $order = order::where('order_id', $order_id)->firstOrFail();

        $order->admin_id = $admin->admin_id;
        $order->status_pesanan = 'Sudah Diverifikasi';
        $order->save();

        return response()->json(['message' => 'Status Reservasi Berhasil Diperbarui!']);
    } 

    public function adminprofile()
        {
            return view('logged-in.profile', ['title' => 'Profile']);            
        }
    
/*
        {{-- OWNER CONTROLLER --}}
*/ 
     
    public function ownerhome()
    {
        return view('owner.home', ['title' => 'Home Owner']);     
    }

    public function ownerprofile()
    {
        return view('logged-in.profile', ['title' => 'Profile']);            
    }

    public function getLatestReportPeriod()
    {
        // Cari laporan terbaru berdasarkan kolom 'period'
        $latestReport = Report::orderBy('period', 'desc')->first();

        if ($latestReport) {
            return response()->json([
                'latest_period' => $latestReport->period, // e.g., "2025-07"
                'latest_type' => $latestReport->type,     // e.g., "monthly"
            ]);
        }

        // Fallback jika tidak ada laporan sama sekali di database
        return response()->json([
            'latest_period' => now()->format('Y-m'),
            'latest_type' => 'monthly',
        ]);
    }

    public function getReport(string $type, string $period){
        $report = Report::with([
                    'daily_report.order.orderDetails.product',
                    'daily_report.order.customer'
                ])
                ->where('report_id', $period)
                ->where('type', $type)
                ->first();

        if (!$report) {
            return response()->json(['message' => 'Laporan tidak ditemukan untuk periode ini.'], 404);
        }

        // --- 1. Menghitung Perubahan Persentase ---
        $previousPeriodId = null;
        if ($type === 'monthly') {
            $previousPeriodId = Carbon::parse($period . "-01")->subMonth()->format('Y-m');
        } elseif ($type === 'yearly') {
            $previousPeriodId = (int)$period - 1;
        }

        $previousReport = Report::where('report_id', $previousPeriodId)->where('type', $type)->first();

        // Helper function untuk kalkulasi persen
        $calculateChange = function ($current, $previous) {
            if ($previous == 0) {
                return $current > 0 ? 100 : 0; // Jika sebelumnya 0, anggap naik 100%
            }
            return round((($current - $previous) / $previous) * 100, 2);
        };

        $revenueChange = $previousReport ? $calculateChange($report->total_revenue, $previousReport->total_revenue) : null;
        $orderChange = $previousReport ? $calculateChange($report->total_order, $previousReport->total_order) : null;
        $avgOrderChange = $previousReport ? $calculateChange($report->average_order, $previousReport->average_order) : null;


        // --- 2. Menentukan Menu Terlaris & Statistiknya ---
        $productSales = [];
        foreach ($report->daily_report as $daily) {
            foreach ($daily->order->orderDetails as $detail) {
                $productId = $detail->product_id;
                if (!isset($productSales[$productId])) {
                    $productSales[$productId] = [
                        'name' => $detail->product->nama,
                        'quantity' => 0
                    ];
                }
                // Menambahkan jumlah dari order utama ke setiap item produk
                $productSales[$productId]['quantity'] += $daily->order->jumlah;
            }
        }

        // Urutkan untuk menemukan yang terlaris
        uasort($productSales, fn($a, $b) => $b['quantity'] <=> $a['quantity']);
        
        $bestSellerName = "N/A";
        $bestSellerStats = "Belum ada data";
        if (!empty($productSales)) {
            $bestSeller = array_key_first($productSales);
            $bestSellerName = $productSales[$bestSeller]['name'];
            $bestSellerStats = "Terjual " . $productSales[$bestSeller]['quantity'] . " Porsi";
        }


        // --- 3. Mempersiapkan Data Chart dan Tabel (Logika Anda yang sudah ada) ---
        $labels = [];
        $values = [];
        $displayPeriodForTitle = "";

        if ($type === 'monthly') {
            $displayPeriodForTitle = Carbon::parse($report->period . "-01")->isoFormat('MMMM YYYY');
            $labels = $report->daily_report->map(fn($dr) => Carbon::parse($dr->tanggal)->format('d'))->toArray();
            $values = $report->daily_report->map(fn($dr) => $dr->getOrderTotal())->toArray();
        } elseif ($type === 'yearly') {
            $displayPeriodForTitle = $report->period;
            $monthlyAggregates = $report->daily_report
                ->groupBy(fn($dr) => Carbon::parse($dr->tanggal)->format('Y-m'))
                ->map(fn($dailyReportsInMonth, $monthYearKey) => [
                    'month_label' => Carbon::parse($monthYearKey . "-01")->isoFormat('MMM'),
                    'total' => $dailyReportsInMonth->sum(fn($dr) => $dr->getOrderTotal()),
                    'sort_key' => $monthYearKey
                ])
                ->sortBy('sort_key');

            $labels = $monthlyAggregates->pluck('month_label')->toArray();
            $values = $monthlyAggregates->pluck('total')->toArray();
        }

        $allOrdersData = $report->daily_report
            ->sortByDesc(fn($dr) => $dr->getOrderTotal()) 
            ->map(fn($dr) => [
                'id'       => $dr->order->order_id,
                'date'     => Carbon::parse($dr->tanggal)->format('d/m/Y'),
                'customer' => $dr->order->customer->name ?? 'N/A',
                'menu'     => $dr->order->orderDetails->pluck('product.nama')->implode(', '),
                'subtotal' => $dr->order->orderDetails->sum('harga_now') * $dr->order->jumlah,
                'discount' => $dr->order->diskon ?? 0,
                'total'    => $dr->getOrderTotal(),
                'status'   => $dr->order->status_pesanan,
            ])->values()->toArray();


        // --- 4. Mengirimkan Respons JSON Lengkap ---
        return response()->json([
            'totalRevenue' => $report->total_revenue,
            'totalOrders'  => $report->total_order,
            'avgOrder'     => $report->average_order,
            'bestSeller'   => $bestSellerName,
            'bestSellerStats' => $bestSellerStats,

            'revenueChange'=> $revenueChange,
            'orderChange'  => $orderChange,
            'avgOrderChange'=> $avgOrderChange,

            'labels'       => $labels,
            'values'       => $values,
            'orders'       => $allOrdersData,

            'displayPeriodForTitle' => $displayPeriodForTitle,
            'reportTypeForTitle' => ($type === 'monthly') ? 'Harian' : 'Bulanan',
        ]);
    }
}
