<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SmartphoneController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HasilController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('auth/login');
})->name('login');

Route::get('/rekomendasi', function () {
    return view('rekomendasi');
})->name('rekomendasi');

Route::get('/daftar', function () {
    return view('daftar');
})->name('daftar');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/list', [SmartphoneController::class, 'view'])->middleware(['auth', 'verified'])->name('list');

Route::get('/listsearch', [SmartphoneController::class, 'search'])->name('listsearch');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/daftar', [SmartphoneController::class, 'store'])->name('smartphones.store');
Route::post('/list{id}', [SmartphoneController::class, 'destroy'])->name('smartphones.destroy');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [LoginController::class, 'createUser']);

Route::post('/login', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');
Route::post('/hasil', [HasilController::class, 'view'])->name('hasil');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::post('/hasil', function () {
//     return view('pages.hasil');
// })->name('hasil');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
