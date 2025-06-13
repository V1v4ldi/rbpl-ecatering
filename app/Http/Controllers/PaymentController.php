<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Http\Controllers\Controller;
use App\Models\order_detail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PaymentController extends Controller
{
    public function show($encrypted_id){
        $customer = auth('customer')->user();

        $order_id = Crypt::decrypt($encrypted_id);

        $order = order::where('order_id', $order_id)->where('customer_id', $customer->customer_id)
        ->with('order_detail.product')->firstOrfail();

        unset($order->order_id);

        $orders = order_detail::where('order_id', $order_id)->get();

        $expiredTime = $order->created_at->addHours(24);
        $remainingSeconds = $expiredTime->timestamp - Carbon::now()->timestamp;
        
        if ($remainingSeconds <= 0) {
            return redirect()->route('checkout')->with('error', 'Waktu pembayaran sudah habis. Order telah dihapus.');
        }
        
        
        return view('logged-in.payment', [
            'title' => 'Payment',
            'order' => $order,
            'remainingSeconds' => $remainingSeconds,
            'expiredTime' => $expiredTime->format('Y-m-d H:i:s'),
            'order_items' => $orders
        ]);
    }

    public function getpayment(){

    }
}
