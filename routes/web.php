<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\SmartphoneController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;

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

Route::get('/hasil', function () {
    return view('hasil');
})->name('hasil');

Route::get('/list', function () {
    return view('list');
})->name('list');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/submit', [RekomendasiController::class, 'handleSubmit'])->name('form.submit'); 
Route::post('/daftar', [SmartphoneController::class, 'store'])->name('smartphones.store');
Route::post('/list{id}', [SmartphoneController::class, 'destroy'])->name('smartphones.destroy');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [LoginController::class, 'createUser']);
Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::post('/login', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');