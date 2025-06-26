<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Artisan;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/run-cron', function (Request $request) {
    // Ambil secret dari header request
    $authorizationHeader = $request->header('Authorization');
    
    // Ambil secret yang kita simpan di environment variable Vercel
    $cronSecret = env('CRON_SECRET');

    // Validasi: Pastikan secret ada dan cocok
    if ($authorizationHeader !== "Bearer {$cronSecret}") {
        // Jika tidak cocok, tolak akses
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // Jika cocok, jalankan command Artisan
    Artisan::call('app:delete-payment');

    // Beri respons sukses
    return response()->json(['message' => 'Cron job executed successfully.']);
});