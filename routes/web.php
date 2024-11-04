<?php

use App\Http\Controllers\admin\CompaniesController;
use App\Http\Controllers\admin\RoutsController;
use App\Http\Controllers\admin\UserController;
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
    // Route::get('/admin/users', 'users')->name('admin.users');
    Route::get('/admin/fees', 'fees')->name('admin.fees');
    // Route::get('/admin/companies', 'companies')->name('admin.companies');
    Route::get('/admin/certification', 'certification')->name('admin.certification');
    Route::get('/admin/add/user', 'add_user')->name('admin.add_user');
});



Route::get('/admin/users', [UserController::class,'index'])->name('admin.users');
Route::get('/admin/users/create', [UserController::class,'create'])->name('admin.create_user');
Route::get('/admin/users/delete/{id}', [UserController::class,'delete'])->name('admin.delete_user');
Route::get('/admin/users/edit/{id}', [UserController::class,'edit'])->name('admin.edit_user');
Route::post('/admin/users/store', [UserController::class,'store'])->name('admin.store_user');
Route::post('/admin/users/update/{id}', [UserController::class,'update'])->name('admin.update_user');


Route::get('/admin/companies', [CompaniesController::class,'index'])->name('admin.companies');
Route::get('/admin/companies/create', [CompaniesController::class,'create'])->name('admin.companies.create');
Route::get('/admin/companies/delete/{id}', [CompaniesController::class,'delete'])->name('admin.delete_company');
Route::get('/admin/companies/edit/{id}', [CompaniesController::class,'edit'])->name('admin.edit_company');
Route::post('/admin/companies/store', [CompaniesController::class,'store'])->name('admin.store_company');
Route::post('/admin/companies/update/{id}', [CompaniesController::class,'update'])->name('admin.update_company');

