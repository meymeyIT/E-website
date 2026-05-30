<?php

use App\Http\Controllers\frontend\frontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Homepage route
Route::get('/', [frontendController::class, 'index'])->name('home');

// Protected profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes
require __DIR__.'/auth.php';

// Admin routes
require __DIR__.'/admin.php';
