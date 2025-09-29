<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return "Sistem Pelaporan Masalah - Teknik Informatika";
});

Route::get('/welcome', function () {
    return "welcome, Hari Ini Saya Belajar Laravel Lagi";
});

Route::get('/laporan', [LaporanController::class, 'index']);