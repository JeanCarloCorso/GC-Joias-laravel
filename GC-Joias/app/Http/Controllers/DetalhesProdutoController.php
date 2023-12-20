<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;

class detalhesProdutoController extends Controller
{
    public function DetalhesProduto($id)
    {
        $produto = Produtos::whereHas('imagens')->where('id', '=', $id)->first();
        $produtosRelacionados = Produtos::where('categoria_id', '=', $produto->categoria_id)
            ->where('id', '!=', $produto->id)
            ->whereHas('imagens')
            ->where('quantidade', '>', 0)
            ->orderBy('created_at', 'DESC')
            ->take(6)
            ->get();

        $produtosCount = $produtosRelacionados->count();

        if ($produtosCount < 6) {
            $produtosComplementares = Produtos::where('id', '!=', $produto->id)
                ->whereHas('imagens')
                ->where('quantidade', '>', 0)
                ->orderBy('created_at', 'DESC') 
                ->take(6 - $produtosCount) 
                ->get();

            $produtosRelacionados = $produtosRelacionados->merge($produtosComplementares);
        }
        
        return view('detalheProduto', 
            ['produto' => $produto, 'produtosRelacionados' => $produtosRelacionados]);
    }
}
