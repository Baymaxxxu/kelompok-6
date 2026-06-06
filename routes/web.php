<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\IncomingDonationController;
use App\Http\Controllers\OutgoingDistributionController;
use App\Http\Controllers\ReportController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('kategori', CategoryController::class)->names('categories');
Route::resource('barang', ItemController::class)->names('items');
Route::resource('donatur', DonorController::class)->names('donors');
Route::resource('penerima', RecipientController::class)->names('recipients');

Route::resource('bantuan-masuk', IncomingDonationController::class)
    ->names('incoming-donations');

Route::resource('distribusi', OutgoingDistributionController::class)
    ->names('outgoing-distributions');

Route::get('/laporan', [ReportController::class, 'index'])->name('reports.index');