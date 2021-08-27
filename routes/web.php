<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\MovimentacaoController;
use Illuminate\Support\Facades\Route;

Route::resource('contas', ContaController::class)
    ->except(['create', 'show', 'edit'])
    ->middleware(['auth', 'verified']);

Route::resource('categorias', CategoriaController::class)
    ->except(['create', 'show', 'edit'])
    ->middleware(['auth', 'verified']);

Route::get('/', [MovimentacaoController::class, 'dashboard'])
    ->name('dashboard')
    ->middleware(['auth', 'verified']);

Route::resource('movimentacoes', MovimentacaoController::class)
    ->parameters(['movimentacoes' => 'movimentacao'])
    ->except(['create', 'show', 'edit'])
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
