<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/registrasi', function () {
    return view('register');
});

Route::get('/products', function () {
    return view('products');
});
Route::get('/product/{id}', function () {
    return view('product');
});
