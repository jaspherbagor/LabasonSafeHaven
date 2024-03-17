<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

/* Admin Routes */

Route::get('/admin/home', [AdminHomeController::class, 'index'])->name('admin_home');
Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin_login');
Route::get('/admin/forgot-password', [AdminLoginController::class, 'forget_password'])->name('admin_forget_password');