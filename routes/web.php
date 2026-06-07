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

    /*
    |--------------------------------------------------------------------------
    | Master Data - Admin dan Petugas boleh melihat
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,petugas')->group(function () {
        Route::get('/kategori', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/barang', [ItemController::class, 'index'])->name('items.index');
        Route::get('/donatur', [DonorController::class, 'index'])->name('donors.index');
        Route::get('/penerima', [RecipientController::class, 'index'])->name('recipients.index');
    });

    /*
    |--------------------------------------------------------------------------
    | Master Data - Admin saja boleh tambah/edit/hapus
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')->group(function () {
        Route::get('/kategori/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/kategori', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/kategori/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/kategori/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::patch('/kategori/{category}', [CategoryController::class, 'update']);
        Route::delete('/kategori/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('/barang/create', [ItemController::class, 'create'])->name('items.create');
        Route::post('/barang', [ItemController::class, 'store'])->name('items.store');
        Route::get('/barang/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
        Route::put('/barang/{item}', [ItemController::class, 'update'])->name('items.update');
        Route::patch('/barang/{item}', [ItemController::class, 'update']);
        Route::delete('/barang/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

        Route::get('/donatur/create', [DonorController::class, 'create'])->name('donors.create');
        Route::post('/donatur', [DonorController::class, 'store'])->name('donors.store');
        Route::get('/donatur/{donor}/edit', [DonorController::class, 'edit'])->name('donors.edit');
        Route::put('/donatur/{donor}', [DonorController::class, 'update'])->name('donors.update');
        Route::patch('/donatur/{donor}', [DonorController::class, 'update']);
        Route::delete('/donatur/{donor}', [DonorController::class, 'destroy'])->name('donors.destroy');

        Route::get('/penerima/create', [RecipientController::class, 'create'])->name('recipients.create');
        Route::post('/penerima', [RecipientController::class, 'store'])->name('recipients.store');
        Route::get('/penerima/{recipient}/edit', [RecipientController::class, 'edit'])->name('recipients.edit');
        Route::put('/penerima/{recipient}', [RecipientController::class, 'update'])->name('recipients.update');
        Route::patch('/penerima/{recipient}', [RecipientController::class, 'update']);
        Route::delete('/penerima/{recipient}', [RecipientController::class, 'destroy'])->name('recipients.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Bantuan Masuk - Admin dan Petugas
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,petugas')->group(function () {
        Route::get('/bantuan-masuk', [IncomingDonationController::class, 'index'])->name('incoming-donations.index');
        Route::get('/bantuan-masuk/create', [IncomingDonationController::class, 'create'])->name('incoming-donations.create');
        Route::post('/bantuan-masuk', [IncomingDonationController::class, 'store'])->name('incoming-donations.store');
        Route::get('/bantuan-masuk/{incomingDonation}', [IncomingDonationController::class, 'show'])->name('incoming-donations.show');

        Route::get('/distribusi', [OutgoingDistributionController::class, 'index'])->name('outgoing-distributions.index');
        Route::get('/distribusi/create', [OutgoingDistributionController::class, 'create'])->name('outgoing-distributions.create');
        Route::post('/distribusi', [OutgoingDistributionController::class, 'store'])->name('outgoing-distributions.store');
        Route::get('/distribusi/{outgoingDistribution}', [OutgoingDistributionController::class, 'show'])->name('outgoing-distributions.show');

        Route::get('/laporan', [ReportController::class, 'index'])->name('reports.index');
    });

    /*
    |--------------------------------------------------------------------------
    | Hapus Transaksi - Admin saja
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')->group(function () {
        Route::delete('/bantuan-masuk/{incomingDonation}', [IncomingDonationController::class, 'destroy'])->name('incoming-donations.destroy');
        Route::delete('/distribusi/{outgoingDistribution}', [OutgoingDistributionController::class, 'destroy'])->name('outgoing-distributions.destroy');
    });
});