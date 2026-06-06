<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('kategori', CategoryController::class)->names('categories');
Route::resource('barang', ItemController::class)->names('items');