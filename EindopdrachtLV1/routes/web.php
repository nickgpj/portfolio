<?php

use Illuminate\Support\Facades\Route;
use App\Http\COntrollers\CharacterController;

Route::get('/characters', function () {
    return view('index');
});

Route::get('/characters', [CharacterController::class, 'index'])->name('index');

Route::get('characters/create', [CharacterController::class, 'create'])->name('create');
Route::post('/characters', [CharacterController::class, 'store'])->name('store');

Route::get('characters/{id}', [CharacterController::class, 'show'])->name('characters.show');

Route::get('/characters/edit/{id}', [CharacterController::class, 'edit'])->name('characters.edit');
Route::put('/characters/{id}', [CharacterController::class, 'update'])->name('characters.update');

Route::delete('/characters/{id}', [CharacterController::class, 'destroy'])->name('destroy');


