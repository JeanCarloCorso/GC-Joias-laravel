<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Produtos;

class ProdutosHomensController extends Controller
{
    public function Show()
    {
        $produtosComImagemPrincipal = Produtos::whereHas('imagens')
            ->where('quantidade', '>', 0)
            ->where(function ($query) {
                $query->where('genero_id', 2)
                    ->orWhere('genero_id', 3);
            })
            ->orderBy('created_at', 'desc')
            ->get();
        
        $categorias = Categorias::all();
        
        return view('produtos', 
            ['produtoscomImagens' => $produtosComImagemPrincipal, 'categorias' => $categorias, 'genero' => 'HOMENS']);
    }
}
