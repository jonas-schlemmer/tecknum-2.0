<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmeController;

Route::get('/', [FilmeController::class, 'index'])->name('filmes.index');
Route::post('/', [FilmeController::class, 'store'])->name('filmes.store');

Route::get('/filmes/{filme}/edit', [FilmeController::class, 'edit'])->name('filmes.edit');
Route::put('/filmes/{filme}', [FilmeController::class, 'update'])->name('filmes.update');
Route::delete('/filmes/{filme}', [FilmeController::class, 'destroy'])->name('filmes.destroy');
