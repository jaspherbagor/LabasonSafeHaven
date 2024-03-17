<?php

use App\Http\Controllers\Admin\AdminHomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

/* Admin Routes */

Route::get('/admin/home', [AdminHomeController::class, 'index'])->name('admin_home');
