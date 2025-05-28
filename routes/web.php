<?php

use App\Models\product;
use App\Http\Controllers\Alluser;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Menucontroller;
use App\Http\Controllers\LoginController;
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
    return view('testing', ['title' => 'TEST', 'daftar' => 'true']);
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

Route::get('/checkout', function () {
    return view('logged-in.cart', ['title' => 'E-Catering']);
})->name('checkout')->middleware('auth:customer');

Route::get('/order', function () {
    $products = product::paginate(8);
    return view('logged-in.order', ['title' => 'E-Catering'], compact('products'));
})->name('order')->middleware('auth:customer');

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