<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth', 'verified')->name('dashboard');

Route::get('/motorcycles', function () {
    return view('motorcycles');
})->middleware(['auth', 'verified'])->name('motorcycles');

Route::get('/motorcycles/create', function () {
    return view('create_motorcycle');
})->middleware(['auth', 'verified'])->name('motorcycles.create');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
