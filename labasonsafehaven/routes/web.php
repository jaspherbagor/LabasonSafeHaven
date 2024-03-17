<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\WebsiteController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;


Route::get('/', [WebsiteController::class, 'index'])->name('home');

Route::get('/dashboard-user', [WebsiteController::class, 'dashboardUser'])->name('dashboard_user')->middleware('auth');

Route::get('/login', [WebsiteController::class, 'login'])->name('login');

Route::post('/login-submit', [WebsiteController::class, 'loginSubmit'])->name('login_submit');

Route::get('/logout', [WebsiteController::class, 'logout'])->name('logout');

Route::get('/registration', [WebsiteController::class, 'registration'])->name('registration');
Route::post('/registration_submit', [WebsiteController::class, 'registrationSubmit'])->name('registration_submit');

Route::get('/registration/verify/{token}/{email}', [WebsiteController::class, 'registrationVerify']);

Route::get('/forget-password', [WebsiteController::class, 'forgetPassword'])->name('forget_password');

Route::post('/forget-password-submit', [WebsiteController::class, 'forgetPasswordSubmit'])->name('forget_password_submit');

Route::get('/reset-password/{token}/{email}', [WebsiteController::class, 'resetPassword'])->name('reset_password');

Route::post('/reset-password-submit', [WebsiteController::class, 'resetPasswordSubmit'])->name('reset_password_submit');

/* Admin */
Route::get('admin/login', [AdminController::class, 'login'])->name('admin_login');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard_admin')->middleware('admin_dashboard');

Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin_settings')->middleware('admin');
