<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin/index');
});


Route::get('/membership', function () {
    return view('admin/membership');
});

Route::get('/fees', function () {
    return view('admin/fees');
});

Route::get('/payment', function () {
    return view('admin/payment');
});
