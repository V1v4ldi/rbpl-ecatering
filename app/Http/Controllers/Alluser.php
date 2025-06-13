<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\order_detail;

class Alluser extends Controller
{
/*
        {{-- Customer Controller --}}
*/  
    public function customerprofile()
        {
            return view('logged-in.profile', ['title' => 'Profile']);            
        }

/*
        {{-- ADMIN CONTROLLER --}}
*/
    public function adminhome(){
        $orders = order::all();
    
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
        
        $products = product::paginate(8);
        return view('admin.home', ['title' => 'Home Admin'], compact('products', 'orders', 'total'));
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
}
