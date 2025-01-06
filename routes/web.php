<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SmartphoneController;

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Home');
    })->name('dashboard');

    Route::get('/matrix', function () {
        return Inertia::render('Matrix');
    })->name('matrix');

    Route::get('/rekomendasi', function () {
        return Inertia::render('Rekomendasi');
    })->name('rekomendasi');

    Route::get('/inputdata', function () {
        return Inertia::render('DataForm');
    })->name('inputdata');

    Route::get('/preferensi', function () {
        return Inertia::render('Preferensi');
    })->name('preferensi');

    Route::get('/getsmartphone', [SmartphoneController::class, 'index']);
    Route::get('/getranking', [SmartphoneController::class, 'index']);

    Route::post('/add', [SmartphoneController::class], 'addColumn');

    Route::get('/username', [ProfileController::class, 'get']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
