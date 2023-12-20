<?php

use App\Http\Controllers\AreaRestritaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MensagensController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutosHomensController;
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
Route::post('/login/produtos', [AreaRestritaController::class, 'ProdutosArPorNome'])->name('ar.produtos.filtra.nome');
Route::post('/login/newuser', [AreaRestritaController::class, 'CriaUser'])->name('ar.criar.user');
Route::get('/login/cadastro/user', [AreaRestritaController::class, 'CadastroUser'])->name('ar.cadastro.user');
Route::get('/login/mudasenha', [AreaRestritaController::class, 'TrocarSenha'])->name('ar.trocaSenha');
Route::post('/login/mudasenha', [AreaRestritaController::class, 'SalvarNovaSenha'])->name('ar.salvaSenha');
Route::get('/login/cadastroproduto', [AreaRestritaController::class, 'CadastroDeProduto'])->name('ar.cadastroProduto');
Route::post('/login/cadastroproduto', [AreaRestritaController::class, 'SalvarNovoProduto'])->name('ar.salvaNovoProduto');
Route::delete('/login/delete/{id}', [AreaRestritaController::class, 'ExcluirProduto'])->name('ar.excluirProduto');
Route::get('/login/edit/{id}', [AreaRestritaController::class, 'EditarProduto'])->name('ar.editarProduto');
Route::post('/login/saveedit', [AreaRestritaController::class, 'SalvarEdicaoProduto'])->name('ar.salvarEdicaoProduto');
Route::get('/login/banners', [AreaRestritaController::class, 'Banners'])->name('ar.banners');
Route::post('/login/create/banner', [AreaRestritaController::class, 'SalvarBanner'])->name('ar.salvaNovoBanner');
Route::delete('/login/delete/banner/{id}', [AreaRestritaController::class, 'DeletarBanner'])->name('ar.apagaBanner');
Route::get('/login/categorias', [AreaRestritaController::class, 'Categorias'])->name('ar.categorias');
Route::post('/login/create/categoria', [AreaRestritaController::class, 'SalvarCategoria'])->name('ar.salvaNovaCategoria');
Route::delete('/login/delete/Categoria/{id}', [AreaRestritaController::class, 'DeletarCategoria'])->name('ar.apagaCategoria');
Route::get('/login/mensagens', [MensagensController::class, 'Mensagens'])->name('ar.mensagens');
Route::get('/login/mensagens/{id}', [MensagensController::class, 'MarcarLidaNaoLida'])->name('ar.marcarLidaNaoLida');
Route::post('/login/mensagens', [MensagensController::class, 'OrdenarMensagens'])->name('ar.ordenarMensagens');


Route::get('/', [HomeController::class, 'Show'])->name('home.show');
Route::get('/categoria/homem', [ProdutosHomensController::class, 'Show'])->name('homens.show');
//Route::get('/categoria/mulher', [ProdutosMulheresController::class, 'Show'])->name('mulheres.show');

Route::prefix('filtro')->group(function() {
    Route::any('nome', [HomeController::class, 'FiltraPorNome'])->name('filtra.produto.nome');
});
Route::any('ordenado', [HomeController::class, 'OrdenarProduto'])->name('ordena.produto');
Route::any('produto/{id}', [HomeController::class, 'DetalhesProduto'])->name('produto.detalhes');

Route::get('/privacidade', function () {
    return view('privacidade');
})->name('privacidade.show');

Route::get('/termos', function () {
    return view('termos');
})->name('termos.show');

Route::get('/quemsomos', function () {
    return view('quemsomos');
})->name('quemsomos.show');

Route::get('/contato', function () {
    return view('contato');
})->name('contato.show');

Route::get('/contato/confirmacao', function () {
    return view('confirmacaoMensagem');
})->name('confirmacaoMensagem');

Route::post('/mensagem', [MensagensController::class, 'SalvarMensagem'])->name('salvaNovaMensagem');

