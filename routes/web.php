<?php

use App\Http\Controllers\admin\RoutsController;
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


Route::get('/certification', function () {
    return view('admin/certification');
});

Route::get('/companies', function () {
    return view('admin/companies');
});


Route::get('/users', function () {
    return view('admin/users');
});





Route::controller(RoutsController::class)->group(function () {
    Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
    Route::get('/admin/membership', 'membership')->name('admin.membership');
    Route::get('/admin/payment', 'payment')->name('admin.payment');
    Route::get('/admin/users', 'users')->name('admin.users');
    Route::get('/admin/fees', 'fees')->name('admin.fees');
    Route::get('/admin/companies', 'companies')->name('admin.companies');
    Route::get('/admin/certification', 'certification')->name('admin.certification');
});
