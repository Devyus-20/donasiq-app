<?php

use App\Http\Controllers\CrmController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SesiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SesiController::class, 'index'])->name('login');
Route::post('/login', [SesiController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // CRM
    Route::prefix('crm')->name('crm.')->group(function () {
        Route::get('input-cash', [CrmController::class, 'inputCash'])->name('input_cash');
        Route::post('input-cash', [CrmController::class, 'storeCash'])->name('store_cash');
        Route::get('validasi-transfer', [CrmController::class, 'validasiTransfer'])->name('validasi_transfer');
        Route::post('validasi-transfer/{id}', [CrmController::class, 'confirmTransfer'])->name('confirm_transfer');
        Route::get('history', [CrmController::class, 'history'])->name('history');
    });

    // Keuangan
    Route::prefix('keuangan')->name('keuangan.')->group(function () {
        Route::get('upload-mutasi', [KeuanganController::class, 'uploadMutasiForm'])->name('upload_mutasi');
        Route::post('upload-mutasi', [KeuanganController::class, 'processMutasi'])->name('process_mutasi');
        Route::get('validasi-mutasi', [KeuanganController::class, 'validasiMutasi'])->name('validasi_mutasi');
        Route::get('terima-setoran', [KeuanganController::class, 'terimaSetoranForm'])->name('terima_setoran');
        Route::post('terima-setoran', [KeuanganController::class, 'terimaSetoran'])->name('proses_setoran');
        Route::get('laporan', [KeuanganController::class, 'laporan'])->name('laporan');
    });

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});

require __DIR__.'/auth.php';
