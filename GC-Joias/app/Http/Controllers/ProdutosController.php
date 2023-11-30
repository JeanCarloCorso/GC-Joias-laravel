<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\ImagemProdutos;
use Illuminate\Http\Request;
use App\Models\Produtos;

class ProdutosController extends Controller
{
    public function Show()
    {
        $produtosComImagemPrincipal = Produtos::whereHas('imagens')->get();
        $banners = Banners::all();
        
        if($produtosComImagemPrincipal)
        {
            return view('home', 
                ['produtoscomImagens' => $produtosComImagemPrincipal, 'banners' => $banners]);
        } else {
            return 'Vazio';
        }
        
    }
}
