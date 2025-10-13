<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;

Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('dosen', DosenController::class);
Route::resource('laporan', LaporanController::class)->parameters([
    'laporan' => 'laporan'
]);

Route::get('/', function () {
    return "Sistem Pelaporan Masalah - Teknik Informatika";
});

// Route::get('/welcome', function () {
//     return "welcome, Hari Ini Saya Belajar Laravel Lagi";
// });

// // Route::get('/laporan', [LaporanController::class, 'index']);
// // Route::get('/cari', [LaporanController::class, 'search']);
// // Route::get('/detail', [LaporanController::class, 'detail']);
