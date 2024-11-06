<?php

use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\FeesController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\RoutsController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\admin\CompaniesController;
use App\Http\Controllers\admin\MembershipController;
use App\Http\Controllers\admin\CertificateController;


Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('login');
    })->name('login');

    Route::post('/admin/login', [UserController::class, 'login'])->name('admin.login');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/logout', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');
    Route::controller(RoutsController::class)->group(function () {
        Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
    });



    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.create_user');
    Route::get('/admin/users/delete/{id}', [UserController::class, 'delete'])->name('admin.delete_user');
    Route::get('/admin/users/edit/{id}', [UserController::class, 'edit'])->name('admin.edit_user');
    Route::post('/admin/users/store', [UserController::class, 'store'])->name('admin.store_user');
    Route::post('/admin/users/update/{id}', [UserController::class, 'update'])->name('admin.update_user');


    Route::get('/admin/companies', [CompaniesController::class, 'index'])->name('admin.companies');
    Route::get('/admin/companies/create', [CompaniesController::class, 'create'])->name('admin.companies.create');
    Route::get('/admin/companies/delete/{id}', [CompaniesController::class, 'delete'])->name('admin.delete_company');
    Route::get('/admin/companies/edit/{id}', [CompaniesController::class, 'edit'])->name('admin.edit_company');
    Route::post('/admin/companies/store', [CompaniesController::class, 'store'])->name('admin.store_company');
    Route::post('/admin/companies/update/{id}', [CompaniesController::class, 'update'])->name('admin.update_company');


    Route::get('/admin/certificates/index', [CertificateController::class, 'index'])->name('admin.certification');
    Route::get('/admin/certificates/create', [CertificateController::class, 'create'])->name('admin.certificates.create');
    Route::get('/admin/certificates/delete/{id}', [CertificateController::class, 'delete'])->name('admin.delete_certificate');
    Route::get('/admin/certificates/edit/{id}', [CertificateController::class, 'edit'])->name('admin.edit_certificate');
    Route::post('/admin/certificates/store', [CertificateController::class, 'store'])->name('admin.store_certificate');
    Route::post('/admin/certificates/update/{id}', [CertificateController::class, 'update'])->name('admin.update_certificate');



    Route::get('/admin/payments/index', [PaymentController::class, 'index'])->name('admin.payment');
    Route::get('/admin/payments/create', [PaymentController::class, 'create'])->name('admin.payment.create');
    Route::get('/admin/payments/delete/{id}', [PaymentController::class, 'delete'])->name('admin.delete_payment');
    Route::get('/admin/payments/edit/{id}', [PaymentController::class, 'edit'])->name('admin.edit_payment');
    Route::post('/admin/payments/store', [PaymentController::class, 'store'])->name('admin.store_payment');
    Route::post('/admin/payments/update/{id}', [PaymentController::class, 'update'])->name('admin.update_payment');



    Route::get('/admin/fees/index', [FeesController::class, 'index'])->name('admin.fees');
    Route::get('/admin/fees/create', [FeesController::class, 'create'])->name('admin.fees.create');
    Route::get('/admin/fees/delete/{id}', [FeesController::class, 'delete'])->name('admin.delete_fees');
    Route::get('/admin/fees/edit/{id}', [FeesController::class, 'edit'])->name('admin.edit_fees');
    Route::post('/admin/fees/store', [FeesController::class, 'store'])->name('admin.store_fees');
    Route::post('/admin/fees/update/{id}', [FeesController::class, 'update'])->name('admin.update_fees');



    Route::get('/admin/membership/index', [MembershipController::class, 'index'])->name('admin.membership');
    Route::get('/admin/membership/create', [MembershipController::class, 'create'])->name('admin.membership.create');
    Route::get('/admin/membership/delete/{id}', [MembershipController::class, 'delete'])->name('admin.delete_membership');
    Route::get('/admin/membership/edit/{id}', [MembershipController::class, 'edit'])->name('admin.edit_membership');
    Route::post('/admin/membership/store', [MembershipController::class, 'store'])->name('admin.store_membership');
    Route::post('/admin/membership/update/{id}', [MembershipController::class, 'update'])->name('admin.update_membership');
});
