<?php

namespace App\Http\Controllers;

use App\Models\ImagemProdutos;
use Illuminate\Http\Request;
use App\Models\Produtos;

class ProdutosController extends Controller
{
    public function Show()
    {
        $produtosComImagemPrincipal = Produtos::whereHas('imagens')->get();

        $produtos = Produtos::all();
        $imagens = ImagemProdutos::all();
        if($produtos)
        {
            return view('home', ['produtoscomImagens' => $produtosComImagemPrincipal]);
        } else {
            return 'Vazio';
        }
        
    }
}
