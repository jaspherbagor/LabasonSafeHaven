<?php

use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;


Route::get('/', [WebsiteController::class, 'index'])->name('home');
Route::get('/dashboard', [WebsiteController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::get('/login', [WebsiteController::class, 'login'])->name('login');
Route::post('/login-submit', [WebsiteController::class, 'loginSubmit'])->name('login_submit');

Route::get('/logout', [WebsiteController::class, 'logout'])->name('logout');

Route::get('/registration', [WebsiteController::class, 'registration'])->name('registration');
Route::post('/registration_submit', [WebsiteController::class, 'registrationSubmit'])->name('registration_submit');

Route::get('/registration/verify/{token}/{email}', [WebsiteController::class, 'registrationVerify']);

Route::get('/forget-password', [WebsiteController::class, 'forgetPassword'])->name('forget_password');
Route::post('/forget-password-submit', [WebsiteController::class, 'forgetPasswordSubmit'])->name('forget_password_submit');
Route::get('/reset-password', [WebsiteController::class, 'resetPassword'])->name('reset_password');