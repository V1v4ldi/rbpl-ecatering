<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\cart_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function cart(){
        return view('logged-in.cart', ['title' => 'E-Catering']);
    }
    
    public function takeitem(){
        $customer = auth('customer')->user();

        $cart = cart::where('customer_id', $customer->customer_id)->firstOrfail();

        $items = cart_detail::where('cart_id', $cart->cart_id)->with('product')->get();
        
        return response()->json([
        'success' => true,
        'items' => $items
        ]);
    }

    public function additem(Request $request){
        $request->validate([
            'product_id' => 'required|exists:product,product_id',
        ],['product_id.required' => 'Tidak ada produk yang dikirim!']);

        $customer = auth('customer')->user();
        $cart = cart::where('customer_id', $customer->customer_id)->firstOrfail();
        cart_detail::create([
            'product_id' =>  $request->product_id,
            'cart_id' =>  $cart->cart_id,
        ]);
        return response()->json([
        'success' => true,
        'message' => 'Produk berhasil ditambahkan ke keranjang!'
        ]);
    }

    public function rmitem(Request $request){
        cart_detail::where('cart_d_id', $request->cart_d_id)->delete();

        return response()->json([
        'success' => true,
        'message' => 'Produk berhasil telah dihapus!'
        ]);
    }
}
