<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('produtos', ProdutoController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('marcas', MarcaController::class);
