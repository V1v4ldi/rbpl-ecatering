<?php

use App\Models\product;
use App\Http\Controllers\Alluser;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Menucontroller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('homepage', ['title' => 'Home']);
})->name('homepage')->middleware('guest');

Route::get('/catalog', function () {
    $products = product::paginate(8);
    return view('catalog', ['title' => 'Catalog'], compact('products'));
})->name('catalog');

Route::get('/register', [RegisterController::class, 'showregis'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'showlogin'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'checklogin'])->name('loggingin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dbtest', function () {
    return view('dbtest', ['title' => 'DB TEST']);
});

Route::get('/test', function () {
    $products = product::paginate(8);
    return view('testing', ['title' => 'TEST', 'daftar' => 'true'], compact('products'));
})->name('test');

/*
Guest
<------------------------------------------------------------------------------------------------------->
Authed
*/

Route::get('/home', function(){
    $products = product::paginate(8);
   return view('logged-in.home', ['title' => 'Home'],compact('products')); 
})->name('home')->middleware('auth:customer');

Route::get('/payment', function () {
    return view('logged-in.payment', ['title' => 'Pembayaran']);
})->name('payment');

Route::get('/recipt', function () {
    return view('logged-in.recipt', ['title' => 'E-Catering']);
})->name('recipt');

Route::get('/cart', [CartController::class, 'cart'])->name('checkout')->middleware('auth:customer');
Route::post('/cart/add', [CartController::class, 'additem'])->name('cart.add')->middleware('auth:customer');
Route::post('/cart/remove', [CartController::class, 'rmitem'])->name('cart.remove')->middleware('auth:customer');
Route::get('/cart/items', [CartController::class, 'takeitem'])->name('cart.get')->middleware('auth:customer');

/* 
{{-- ORDER ROUTE --}}
*/

Route::get('/order', [OrderController::class, 'page'])->name('order')->middleware('auth:customer');
Route::get('/order/get', [OrderController::class, 'getorder'])->name('order.get')->middleware('auth:customer');
Route::get('/order/date', [OrderController::class, 'getdate'])->name('order.get.date')->middleware('auth:customer');
Route::post('/order/create', [OrderController::class, 'mkorder'])->name('order.create')->middleware('auth:customer');
Route::post('/order/cancel', [OrderController::class, 'rmorder'])->name('order.cancel')->middleware('auth:customer');

/* 
{{-- PROFILE ROUTE --}}
*/

Route::get('/profile', [Alluser::class, 'customerprofile'])->name('cust.profile')->middleware('auth:customer');

/* 
{{-- ADMIN ROUTE --}}
*/

Route::get('/admin/home', [Alluser::class, 'adminhome'])->name('adminhome')->middleware('auth:admin');
Route::resource('admin/menu', Menucontroller::class)->middleware('auth:admin');
Route::get('/admin/profile', [Alluser::class, 'adminprofile'])->name('admin.profile')->middleware('auth:admin');

/* 
{{-- OWNER ROUTE --}}
*/

Route::get('/owner/home', [Alluser::class, 'ownerhome'])->name('ownerhome')->middleware('auth:owner');
Route::get('/owner/profile', [Alluser::class, 'ownerprofile'])->name('owner.profile')->middleware('auth:owner');