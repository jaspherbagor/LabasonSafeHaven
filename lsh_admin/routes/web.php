<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Customer\WebsiteController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

/* Sample Customer Login Routes */ 
Route::get('/', [WebsiteController::class, 'index'])->name('home');

Route::get('/register', [WebsiteController::class, 'register'])->name('register');

Route::get('/login', [WebsiteController::class, 'login'])->name('login');

/* Admin Routes */

Route::get('/admin/home', [AdminHomeController::class, 'index'])->name('admin_home')->middleware('admin:admin');

Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin_login');

Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin_logout');

Route::post('/admin/login-submit', [AdminLoginController::class, 'loginSubmit'])->name('admin_login_submit');

Route::get('/admin/forget-password', [AdminLoginController::class, 'forgetPassword'])->name('admin_forget_password');

Route::post('/admin/forget-password-submit', [AdminLoginController::class, 'forgetPasswordSubmit'])->name('admin_forget_password_submit');

Route::get('/admin/reset-password/{token}/{email}', [AdminLoginController::class, 'resetPassword'])->name('admin_reset_password');