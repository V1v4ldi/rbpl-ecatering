<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage', ['title' => 'Home']);
});

Route::get('/catalog', function () {
    return view('catalog', ['title' => 'Catalog']);
});

Route::get('/register', function () {
    return view('register', ['title' => 'Register']);
});

Route::get('/login', function () {
    return view('login', ['title' => 'Login']);
});