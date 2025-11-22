<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    if (in_array($user->role, ['dpa', 'admin'])) {
        $laporans = \App\Models\Laporan::with('mahasiswa')->latest()->paginate(10);
    } else {
        $laporans = \App\Models\Laporan::where('mahasiswa_id', $user->mahasiswa_id)->latest()->paginate(10);
    }
    return view('dashboard', compact('laporans'));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Hanya mahasiswa yang bisa membuat, edit, update, hapus, dan lihat laporan
Route::middleware(['auth','\App\Http\Middleware\RoleMiddleware:mahasiswa'])->group(function(){
    Route::resource('laporan', \App\Http\Controllers\LaporanController::class);
});

// Hanya DPA (admin) yang bisa mengelola mahasiswa, dosen, dan melihat semua laporan
Route::middleware(['auth','\App\Http\Middleware\CheckRole:dpa,admin'])->group(function(){
    Route::resource('mahasiswa', \App\Http\Controllers\MahasiswaController::class);
    Route::resource('dosen', \App\Http\Controllers\DosenController::class);
    Route::get('/admin/laporan', [\App\Http\Controllers\LaporanController::class,'index'])->name('admin.laporan.index');
    Route::get('/admin/laporan/{laporan}', [\App\Http\Controllers\LaporanController::class, 'show'])->name('admin.laporan.show');
    Route::patch('/admin/laporan/{laporan}/status', [\App\Http\Controllers\LaporanController::class, 'updateStatus'])->name('admin.laporan.updateStatus');
    Route::delete('/admin/laporan/{laporan}', [\App\Http\Controllers\LaporanController::class, 'destroy'])->name('admin.laporan.destroy');
});

require __DIR__.'/auth.php';
