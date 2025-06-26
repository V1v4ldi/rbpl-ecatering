<?php

use App\Models\product;
use App\Http\Controllers\Alluser;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Menucontroller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('homepage', ['title' => 'Home']);
})->name('homepage')->middleware('guest');

Route::get('/catalog', function () {
    $products = product::paginate(8);
    return view('catalog', ['title' => 'Catalog'], compact('products'));
})->name('catalog');

Route::get('/register', [RegisterController::class, 'showregis'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'showlogin'])->name('login');
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



/* 
{{-- CART ROUTE --}}
*/
Route::get('/cart', [CartController::class, 'cart'])->name('checkout')->middleware('auth:customer');
Route::post('/cart/add', [CartController::class, 'additem'])->name('cart.add')->middleware('auth:customer');
Route::post('/cart/remove', [CartController::class, 'rmitem'])->name('cart.remove')->middleware('auth:customer');
Route::get('/cart/items', [CartController::class, 'takeitem'])->name('cart.get')->middleware('auth:customer');
Route::get('/cart/order/get', [OrderController::class, 'getorder'])->name('order.get')->middleware('auth:customer');
Route::get('/cart/orders/verifed', [CartController::class, 'getOrder'])->name('diproses.get')->middleware('auth:customer');
Route::get('/cart/orders/done', [CartController::class, 'getOrderDone'])->name('orderdone.get')->middleware('auth:customer');

/* 
{{-- ORDER & PRODUCT & PAYMENT ROUTE --}}
*/
Route::get('/payment/{encrypted_id}', [PaymentController::class, 'show'])->name('payment')->middleware('auth:customer');
Route::post('/payment/{encrypted_id}/confirm', [PaymentController::class, 'confirmPayment'])->name('payment.confirm')->middleware('auth:customer');
Route::get('/payment/status/{encrypted_id}', [PaymentController::class, 'getRecipt'])->name('order.status')->middleware('auth:customer');

Route::get('/product/get', [ProductController::class, 'getproductspaginated'])->name('product.get');
Route::get('/order', [OrderController::class, 'page'])->name('order')->middleware('auth:customer');
Route::get('/order/date', [OrderController::class, 'getdate'])->name('order.get.date')->middleware('auth:customer');
Route::post('/order/create', [OrderController::class, 'mkorder'])->name('order.create')->middleware('auth:customer');
Route::post('/order/cancel/{order_id}', [OrderController::class, 'rmorder'])->name('order.cancel')->middleware('auth:customer');

/* 
{{-- PROFILE ROUTE --}}
*/
Route::get('/admin/profile', [Alluser::class, 'userprofile'])->name('admin.profile')->middleware('auth:admin');
Route::post('/admin/profile/change/pass', [Alluser::class, 'changePW'])->name('admin.pass')->middleware(['auth:admin']);
Route::post('/admin/profile/change/prof', [Alluser::class, 'changeProfile'])->name('admin.cred')->middleware(['auth:admin']);

Route::get('/owner/profile', [Alluser::class, 'userprofile'])->name('owner.profile')->middleware('auth:owner');
Route::post('/owner/profile/change/pass', [Alluser::class, 'changePW'])->name('owner.pass')->middleware(['auth:owner']);
Route::post('/owner/profile/change/prof', [Alluser::class, 'changeProfile'])->name('owner.cred')->middleware(['auth:owner']);

Route::get('/profile', [Alluser::class, 'userprofile'])->name('cust.profile')->middleware(['auth:customer']);
Route::post('/profile/change/pass', [Alluser::class, 'changePW'])->name('cust.pass')->middleware(['auth:customer']);
Route::post('/profile/change/prof', [Alluser::class, 'changeProfile'])->name('cust.cred')->middleware(['auth:customer']);
/* 
{{-- ADMIN ROUTE --}}
*/

//tunggal
Route::get('/admin/resv/{reservasiId}', [Alluser::class, 'getReservation'])->name('Getresv')->middleware('auth:admin');
Route::get('/admin/order/{orderId}', [Alluser::class, 'getOrder'])->name('Getorder')->middleware('auth:admin');
//jamak
Route::get('/admin/resv', [Alluser::class, 'getReservations'])->name('getResv')->middleware('auth:admin');
Route::get('/admin/order', [Alluser::class, 'getOrders'])->name('getOrders')->middleware('auth:admin');
//update
Route::put('/admin/resv/update/{reservasiId}', [Alluser::class, 'updateReservation'])->name('updateResv')->middleware('auth:admin');
Route::put('/admin/order/update/{orderId}', [Alluser::class, 'updateOrder'])->name('updateOrder')->middleware('auth:admin');

Route::get('/admin/home', [Alluser::class, 'adminhome'])->name('admin.home')->middleware('auth:admin');
Route::resource('admin/menu', Menucontroller::class)->middleware('auth:admin');


/* 
{{-- OWNER ROUTE --}}
*/

Route::get('/owner/home', [Alluser::class, 'ownerhome'])->name('owner.home')->middleware('auth:owner');
Route::get('/owner/latest-report-period', [Alluser::class, 'getLatestReportPeriod'])
     ->name('owner.latestPeriod')->middleware('auth:owner');
Route::get('/owner/report-data/{type}/{period}', [Alluser::class, 'getReport'])
     ->name('owner.reportData')->middleware('auth:owner');