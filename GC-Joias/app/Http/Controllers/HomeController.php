<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\ImagemProdutos;
use Illuminate\Http\Request;
use App\Models\Produtos;

class HomeController extends Controller
{
    public function Show()
    {
        $produtosComImagemPrincipal = Produtos::whereHas('imagens')->where('quantidade', '>', 0)
            ->orderBy('created_at', 'desc')->get();
        $qtdProdutosUnisex = $produtosComImagemPrincipal->where('genero_id', 3)->count();
        $qtdProdutosMasculinos = $produtosComImagemPrincipal->where('genero_id', 1)->count() + $qtdProdutosUnisex;
        $qtdProdutosFemininos = $produtosComImagemPrincipal->where('genero_id', 2)->count() + $qtdProdutosUnisex;

        $banners = Banners::all();

        $produtosComImagemPrincipal = $produtosComImagemPrincipal->slice(0, 4);

        return view('home', 
            ['produtoscomImagens' => $produtosComImagemPrincipal, 'banners' => $banners, 
            'qtdProdutosMasculinos' => $qtdProdutosMasculinos, 'qtdProdutosFemininos' => $qtdProdutosFemininos]);
    }  
}
