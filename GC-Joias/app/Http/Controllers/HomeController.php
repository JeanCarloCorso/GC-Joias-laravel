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

    public function FiltraPorNome(Request $nome)
    {
        $produtosComImagem = Produtos::where('nome', 'like', '%' . $nome->nome . '%')
        ->whereHas('imagens')->where('quantidade', '>', 0)
        ->get();

        $banners = Banners::all();
        
        return view('home', 
            ['produtoscomImagens' => $produtosComImagem, 'banners' => $banners]);

    }

    public function OrdenarProduto(Request $request)
    {
        $ordenacao = $request->input('ordenacao');

        $produtosOrdenados = Produtos::whereHas('imagens')->where('quantidade', '>', 0);

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

    public function DetalhesProduto($id)
    {
        $produto = Produtos::whereHas('imagens')->where('id', '=', $id)->first();

        return view('detalheProduto', 
            ['produto' => $produto]);
    }
}
