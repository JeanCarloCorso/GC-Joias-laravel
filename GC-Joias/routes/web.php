<?php

use App\Http\Controllers\ProdutosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('user')->group(function() {
    Route::get('', function(){
        return 'usuario';
    });
    Route::get('/{id}', [UserController::class, 'Find']);
    Route::get('', [UserController::class, 'Show']);
});


Route::get('/', [ProdutosController::class, 'Show']);

Route::prefix('filtro')->group(function() {
    Route::any('nome', [ProdutosController::class, 'FiltraPorNome'])->name('filtra.produto.nome');
});
Route::any('ordenado', [ProdutosController::class, 'OrdenarProduto'])->name('ordena.produto');

Route::get('/filtro/nome', [ProdutosController::class, 'Show']);

Route::get('/privacidade', function () {
    return view('privacidade');
});

Route::get('/termos', function () {
    return view('termos');
});

Route::get('/quemsomos', function () {
    return view('quemsomos');
});

Route::get('/contato', function () {
    return view('contato');
});
