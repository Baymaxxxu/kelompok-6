<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\RecipientController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('kategori', CategoryController::class)->names('categories');
Route::resource('barang', ItemController::class)->names('items');
Route::resource('donatur', DonorController::class)->names('donors');
Route::resource('penerima', RecipientController::class)->names('recipients');