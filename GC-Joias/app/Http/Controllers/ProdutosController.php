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
        $produtosComImagemPrincipal = Produtos::whereHas('imagens')->orderBy('nome', 'asc')->get();
        $banners = Banners::all();

        if($produtosComImagemPrincipal)
        {
            return view('home', 
                ['produtoscomImagens' => $produtosComImagemPrincipal, 'banners' => $banners]);
        } else {
            return 'Vazio';
        }
        
    }

    public function FiltraPorNome(Request $nome)
    {
        $produtosComImagem = Produtos::where('nome', 'like', '%' . $nome->nome . '%')
        ->whereHas('imagens')
        ->get();

        $banners = Banners::all();
        
        if($produtosComImagem)
        {
            return view('home', 
                ['produtoscomImagens' => $produtosComImagem, 'banners' => $banners]);
        } else {
            return 'Vazio';
        }
        
    }

    public function OrdenarProduto(Request $request)
    {
        $ordenacao = $request->input('ordenacao');

        $produtosOrdenados = Produtos::whereHas('imagens');

        switch ($ordenacao) {
            case '1':
                // Ordenar pelo menor preço
                $produtosOrdenados->orderBy('preco');
                break;
            case '2':
                // Ordenar pelo maior preço
                $produtosOrdenados->orderByDesc('preco');
                break;
            case '3':
                // Ordenar pelo mais recente (pela coluna created_at)
                $produtosOrdenados->orderBy('created_at', 'desc');
                break;
            case '4':
                // Ordenar pelo mais antigo (pela coluna created_at)
                $produtosOrdenados->orderBy('created_at');
                break;
            default:
                // Ordenar pelo nome (padrão)
                $produtosOrdenados->orderBy('nome');
                break;
        }

        $produtosComImagemPrincipal = $produtosOrdenados->get();
        $banners = Banners::all();
        return view('home', ['produtoscomImagens' => $produtosComImagemPrincipal, 'banners' => $banners]);
    }
}
