<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminSlideController as AdminAdminSlideController;
use App\Http\Controllers\AdminSlideController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\HomeController;
// use App\Http\Controllers\Customer\WebsiteController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');

/* Sample Customer Login Routes */ 
// Route::get('/', [WebsiteController::class, 'index'])->name('home');

// Route::get('/register', [WebsiteController::class, 'register'])->name('register');

// Route::get('/login', [WebsiteController::class, 'login'])->name('login');

/* Admin Routes */

Route::get('/admin/home', [AdminHomeController::class, 'index'])->name('admin_home')->middleware('admin:admin');

Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin_login');

Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin_logout');

Route::post('/admin/login-submit', [AdminLoginController::class, 'loginSubmit'])->name('admin_login_submit');

Route::get('/admin/forget-password', [AdminLoginController::class, 'forgetPassword'])->name('admin_forget_password');

Route::post('/admin/forget-password-submit', [AdminLoginController::class, 'forgetPasswordSubmit'])->name('admin_forget_password_submit');

Route::get('/admin/reset-password/{token}/{email}', [AdminLoginController::class, 'resetPassword'])->name('admin_reset_password');

Route::post('/admin/reset-password-submit', [AdminLoginController::class, 'resetPasswordSubmit'])->name('admin_reset_password_submit');


Route::get('/admin/edit-profile', [AdminProfileController::class, 'index'])->middleware('admin:admin')->name('admin_profile');

Route::post('/admin/edit-profile-submit', [AdminProfileController::class, 'profileSubmit'])->middleware('admin:admin')->name('admin_profile_submit');

Route::get('/admin/slide/view', [AdminAdminSlideController::class, 'index'])->name('admin_slide_view')->middleware('admin:admin');

Route::get('/admin/slide/add', [AdminAdminSlideController::class, 'add'])->name('admin_slide_add')->middleware('admin:admin');

Route::post('/admin/slide/store', [AdminAdminSlideController::class, 'store'])->name('admin_slide_store')->middleware('admin:admin');

Route::get('/admin/slide/edit/{id}', [AdminAdminSlideController::class, 'edit'])->name('admin_slide_edit')->middleware('admin:admin');

Route::post('/admin/slide/update/{id}', [AdminAdminSlideController::class, 'update'])->name('admin_slide_update')->middleware('admin:admin');