<?php

use App\Http\Controllers\AreaRestritaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdutosController;
use Illuminate\Auth\Events\Login;
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

Route::controller(LoginController::class)->group(function() 
{
    Route::get('/login', 'index')->name('login.index');
    Route::post('/login', 'store')->name('login.store');
    Route::get('/logout', 'destroy')->name('login.destroy');
});
Route::get('/login/produtos', [AreaRestritaController::class, 'ProdutosAr'])->name('ar.produtos');
Route::post('/login/newuser', [AreaRestritaController::class, 'CriaUser'])->name('ar.criar.user');
Route::get('/login/cadastro/user', [AreaRestritaController::class, 'CadastroUser'])->name('ar.cadastro.user');


Route::get('/', [ProdutosController::class, 'Show'])->name('home.show');

Route::prefix('filtro')->group(function() {
    Route::any('nome', [ProdutosController::class, 'FiltraPorNome'])->name('filtra.produto.nome');
});
Route::any('ordenado', [ProdutosController::class, 'OrdenarProduto'])->name('ordena.produto');

//Route::get('/filtro/nome', [ProdutosController::class, 'Show']);

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
