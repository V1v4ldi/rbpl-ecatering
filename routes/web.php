<?php

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('homepage', ['title' => 'Home']);
})->name('homepage')->middleware('guest');

Route::get('/catalog', function () {
    return view('catalog', ['title' => 'Catalog']);
})->name('catalog');

Route::get('/register', [RegisterController::class, 'showregis'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'showlogin'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'checklogin'])->name('loggingin');

Route::get('/dbtest', function () {
    return view('dbtest', ['title' => 'DB TEST']);
});

Route::get('/test', function () {
    return view('testing', ['title' => 'TEST', 'daftar' => 'true']);
});

/*
Guest
<------------------------------------------------------------------------------------------------------->
Authed
*/

Route::get('/home', function(){
   return view('logged-in.home', ['title' => 'Home']); 
})->name('home')->middleware('auth');

Route::get('/payment', function () {
    return view('logged-in.payment', ['title' => 'Pembayaran']);
})->name('payment');

Route::get('/recipt', function () {
    return view('logged-in.recipt', ['title' => 'E-Catering']);
})->name('recipt');

Route::get('/checkout', function () {
    return view('logged-in.cart', ['title' => 'E-Catering']);
})->name('checkout');