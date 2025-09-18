<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengunjungController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// ✅ Route to dashboard using controller
Route::get('/dashboard', [PengunjungController::class, 'index'])->name('dashboard');

// ✅ Resource routes (for create, edit, update, delete)
Route::resource('pengunjung', PengunjungController::class);
// ✅ Route to delete a resource
Route::delete('pengunjung/{id}', [PengunjungController::class, 'destroy'])->name('pengunjung.destroy');