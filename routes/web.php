<?php

use App\Http\Controllers\CategoriaProdutoController;
use App\Http\Controllers\FornecedorProdutoController;
use App\Http\Controllers\LoteProdutoController;
use App\Http\Controllers\MarcaProdutoController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resources([
    'marca' => MarcaProdutoController::class,
    'categoria' => CategoriaProdutoController::class,
    'fornecedor' => FornecedorProdutoController::class,
    'lote' => LoteProdutoController::class,
    'produto' => ProdutoController::class,
]);
