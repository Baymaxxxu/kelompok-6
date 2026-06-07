<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\IncomingDonationController;
use App\Http\Controllers\OutgoingDistributionController;
use App\Http\Controllers\ReportController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('kategori', CategoryController::class)
        ->names('categories')
        ->parameters([
            'kategori' => 'category',
        ]);

    Route::resource('barang', ItemController::class)
        ->names('items')
        ->parameters([
            'barang' => 'item',
        ]);

    Route::resource('donatur', DonorController::class)
        ->names('donors')
        ->parameters([
            'donatur' => 'donor',
        ]);

    Route::resource('penerima', RecipientController::class)
        ->names('recipients')
        ->parameters([
            'penerima' => 'recipient',
        ]);

    Route::resource('bantuan-masuk', IncomingDonationController::class)
        ->names('incoming-donations')
        ->parameters([
            'bantuan-masuk' => 'incomingDonation',
        ]);

    Route::resource('distribusi', OutgoingDistributionController::class)
        ->names('outgoing-distributions')
        ->parameters([
            'distribusi' => 'outgoingDistribution',
        ]);

    Route::get('/laporan', [ReportController::class, 'index'])->name('reports.index');
});