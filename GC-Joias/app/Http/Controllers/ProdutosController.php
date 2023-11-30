<?php

namespace App\Http\Controllers;

use App\Models\ImagemProdutos;
use Illuminate\Http\Request;
use App\Models\Produtos;

class ProdutosController extends Controller
{
    public function Show()
    {
        $produtos = Produtos::all();
        if($produtos)
        {
            return view('home', ['produtos' => $produtos]);
        } else {
            return 'Vazio';
        }
        
    }
}
