<?php

use App\Http\Controllers\CategoriaProdutoController;
use App\Http\Controllers\FornecedorProdutoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoteProdutoController;
use App\Http\Controllers\MarcaProdutoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\RegistroEstoqueController;
use App\Http\Controllers\UsuarioController;
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

Route::redirect('/', 'login');

Route::prefix('login')->group(function () {
    Route::get('', [LoginController::class, 'mostrarFormularioLogin'])
        ->name('login');
    Route::post('autenticar', [LoginController::class, 'autenticarUsuario'])
        ->name('autenticar');
    Route::get('deslogar', [LoginController::class, 'deslogarUsuario'])
        ->name('deslogar');
});

Route::resource('usuario', UsuarioController::class)
    ->except('index', 'create', 'show');

Route::middleware(['auth'])->group(function () {
    Route::prefix('inicio')->group(function () {
        Route::get('', [InicioController::class, 'mostrarCategorias'])->name('inicio');
        Route::get('pesquisa/{categoriaId}/{nomeProduto?}', [InicioController::class, 'mostrarProdutosCategoria'])
            ->name('inicio.pesquisa');
        Route::get('detalhe/{produtoId}', [InicioController::class, 'mostrarDetalhesProduto'])
            ->name('inicio.detalhamento');
    });

    Route::resources([
        'marca' => MarcaProdutoController::class,
        'categoria' => CategoriaProdutoController::class,
        'fornecedor' => FornecedorProdutoController::class,
        'lote' => LoteProdutoController::class,
        'produto' => ProdutoController::class,
        'registro' => RegistroEstoqueController::class,
    ], ['except', 'show']);
});
