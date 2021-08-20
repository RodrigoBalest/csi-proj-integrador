<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::resource('contas', ContaController::class)
    ->except(['create', 'show', 'edit'])
    ->middleware(['auth', 'verified']);

Route::resource('categorias', CategoriaController::class)
    ->except(['create', 'show', 'edit'])
    ->middleware(['auth', 'verified']);

Route::get('/', [IndexController::class, 'index'])
    ->name('dashboard')
    ->middleware(['auth', 'verified']);













Route::get('/info', function () {
    return phpinfo();
});




Route::get('/movimentacoes', function () {
    return view('movimentacoes');
})->name('movimentacoes')->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
