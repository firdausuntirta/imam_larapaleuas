<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [PageController::class, 'landingpage'])->name('landingpage');
Route::get('/admin', [LoginController::class, 'login'])->name('login');
Route::post('/admin/postLogin', [LoginController::class, 'postLogin'])->name('postLogin');
Route::get('/admin/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('/admin/buttons', [PageController::class, 'buttons'])->name('buttons');
Route::get('/admin/cards', [PageController::class, 'cards'])->name('cards');

Route::get('/admin/pengunjung/display', [PengunjungController::class, 'index'])->name('pengunjung.display');
Route::get('/admin/pengunjung/create', [PengunjungController::class, 'create'])->name('pengunjung.create');
Route::post('/pengunjung', [PengunjungController::class, 'store'])->name('pengunjung.store');
Route::get('/pengunjung/edit/{id}', [PengunjungController::class, 'edit'])->name('pengunjung.edit');
Route::post('/pengunjung/update/{id}', [PengunjungController::class, 'update'])->name('pengunjung.update');
Route::delete('/pengunjung/delete/{id}', [PengunjungController::class, 'destroy'])->name('pengunjung.delete');

//api
Route::get('/pengunjung/data-pengunjung-pertahun', [PengunjungController::class, 'getDataPengunjung'])->name('pengunjung.getData');


require __DIR__ . '/auth.php';
