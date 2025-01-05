<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileManagerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Change auth:sanctum to auth:web for session authentication
Route::middleware(['auth:web'])->prefix('file-manager')->group(function () {
    Route::get('/', [FileManagerController::class, 'index']);
    Route::post('/upload', [FileManagerController::class, 'upload']);
    Route::post('/create-directory', [FileManagerController::class, 'createDirectory']);
    Route::delete('/delete', [FileManagerController::class, 'delete']);
    Route::get('/download/{path}', [FileManagerController::class, 'download']);

});
