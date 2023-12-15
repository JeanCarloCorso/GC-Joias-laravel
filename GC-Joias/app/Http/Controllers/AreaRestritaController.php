<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\Categorias;
use App\Models\Generos;
use App\Models\ImagemProdutos;
use App\Models\Produtos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AreaRestritaController extends Controller
{
    public function ProdutosAr()
    {
        if(Auth()->check())
        {
            $produtos = Produtos::whereHas('imagens')->orderBy('nome', 'asc')->get();

            return view('areaRestrita/ar_produtos', ['produtos' => $produtos]);
        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }

    public function ProdutosArPorNome(Request $request)
    {
        if(Auth()->check())
        {
            $produtos = Produtos::where('nome', 'like', '%' . $request->nome . '%')
            ->whereHas('imagens')->get();

            return view('areaRestrita/ar_produtos', ['produtos' => $produtos]);
        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }

    public function CriaUser(Request $request)
    {
        
        if(Auth()->check())
        {
            $request->validate([
                'nome' => 'required|min:3',
                'email' => 'required|email',
                'password' => 'required|min:8',
                'passwordConfirm' => 'same:password'
            ], [
                'nome.required' => 'O campo nome é obrigatório!',
                'nome.min' => 'O nome deve conter no mínimo :min caracteres!',
                'email.required' => 'O campo e-mail é obrigatório!',
                'email.email' => 'Informe um email válido!',
                'password.required' => 'O campo senha é obrigatório!',
                'password.min' => 'A senha deve conter no mínimo :min caracteres!',
                'passwordConfirm.same' => 'A senha e a confirmação devem ser iguais'
            ]);

            $userExists = User::where('email', $request->email)->exists();
            if($userExists)
            {
                return redirect()->route('ar.cadastro.user')->withErrors(['usuarioExistente' => 'O Usuário com o e-mail ' . $request->email . ' já existe!']);
            }
            $new = [
                'name' => $request->nome,
                'email' => $request->email,
                'password' => $request->senha,
            ];

            $new['password'] = Hash::make($request->password);

            $user = User::create($new);

            return redirect()->route('ar.produtos')->with(['usuarioCadastrado' => 'Usuário cadastrado com suscesso!']);
        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }


    public function CadastroUser()
    {
        if(Auth()->check())
        {
            return view('areaRestrita/ar_cadastroUser');
        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }

    public function TrocarSenha()
    {
        if(Auth()->check())
        {
            return view('areaRestrita/ar_trocaSenha');
        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }

    public function SalvarNovaSenha(Request $request)
    {
        if(Auth()->check())
        {
            $user = auth()->user();
            $request->validate([
                'password' => 'required|min:8',
                'passwordConfirm' => 'same:password'
            ], [
                'password.required' => 'O campo senha é obrigatório!',
                'password.min' => 'A senha deve conter no mínimo :min caracteres!',
                'passwordConfirm.same' => 'A senha e a confirmação devem ser iguais'
            ]);

            $user->password = Hash::make($request->password);
            $user->save();

            
            return redirect()->route('ar.produtos')->with(['senhaAlterada' => 'Senha alterada com suscesso!']);
        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }

    public function CadastroDeProduto()
    {
        if(Auth()->check())
        {
            $generos = Generos::all();
            $categorias = Categorias::all();
            return view('areaRestrita/ar_cadastroProduto', ['generos' => $generos, 'categorias' => $categorias]);
        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }

    public function SalvarNovoProduto(Request $request)
    {
        if(Auth()->check())
        {
            $request->validate([
                'nome' => 'required|min:3',
                'quantidade' => 'required',
                'preco' => 'required',
                'descricaoCurta' => 'required',
                'descricaoDetalhada' => 'required',
                'genero' => 'required',
                'categoria' => 'required',
                'imagen01' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'imagen02' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'imagen03' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'imagen04' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'nome.required' => 'O campo nome é obrigatório!',
                'nome.min' => 'O nome deve conter no mínimo :min caracteres!',
                'quantidade.required' => 'O campo quantidade é obrigatório!',
                'preco.required' => 'O campo preco é obrigatório!',
                'descricaoCurta.required' => 'O campo descrição é obrigatório!',
                'descricaoDetalhada.required' => 'O campo descrição é obrigatório!',
                'genero.required' => 'Escolha um genero para o produto!',
                'categoria.required' => 'Escolha uma categoria para o produto!',
                'imagen01.required' => 'A primeira imagem é obrigatória!',
            ]);

            $novoProduto = Produtos::create([
                'nome' => $request->nome,
                'quantidade' => $request->quantidade,
                'custo' => $request->custo,
                'preco' => $request->preco,
                'categoria_id' => $request->categoria,
                'genero_id' => $request->genero,
                'descricao_curta' => $request->descricaoCurta,
                'descricao_detalhada' => $request->descricaoDetalhada,
            ]);

            if ($request->hasFile('imagen01')) {
                $caminhoImagem = $request->imagen01->store('img/produtos', 'public');
                ImagemProdutos::create([
                    'produto_id' => $novoProduto->id,
                    'path' => $caminhoImagem,
                    'principal' => true
                ]);
            }

            if ($request->hasFile('imagen02')) {
                $caminhoImagem = $request->imagen02->store('img/produtos', 'public');
                ImagemProdutos::create([
                    'produto_id' => $novoProduto->id,
                    'path' => $caminhoImagem,
                    'principal' => false
                ]);
            }
            
            if ($request->hasFile('imagen03')) {
                $caminhoImagem = $request->imagen03->store('img/produtos', 'public');
                ImagemProdutos::create([
                    'produto_id' => $novoProduto->id,
                    'path' => $caminhoImagem,
                    'principal' => false
                ]);
            }

            if ($request->hasFile('imagen04')) {
                $caminhoImagem = $request->imagen04->store('img/produtos', 'public');
                ImagemProdutos::create([
                    'produto_id' => $novoProduto->id,
                    'path' => $caminhoImagem,
                    'principal' => false
                ]);
            }

            return redirect()->route('ar.produtos')->with(['produtoCadastrado' => 'Produto cadastrado com suscesso!']);
        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }

    public function ExcluirProduto($id)
    {
        if(Auth()->check())
        {
            $produto = Produtos::findOrFail($id);
            $imagens = ImagemProdutos::where('produto_id', '=', $id)->get();
            
            foreach ($imagens as $imagem) {
                if (Storage::disk('public')->exists($imagem->path)) {
                    Storage::disk('public')->delete($imagem->path);
                }
            }

            $produto->delete();

            return redirect()->route('ar.produtos')->with(['produtoExcluido' => 'Produto excluido com suscesso!']);
        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }

    public function EditarProduto($id)
    {
        if(Auth()->check())
        {
            $produto = Produtos::whereHas('imagens')->findOrFail($id);
            $generos = Generos::all();
            $categorias = Categorias::all();

            return view('areaRestrita/ar_edicaoProduto', ['produto' => $produto, 
                'generos' => $generos, 'categorias' => $categorias]);

        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }

    public function SalvarEdicaoProduto(Request $request)
    {
        if(Auth()->check())
        {
            $request->validate([
                'nome' => 'required|min:3',
                'quantidade' => 'required',
                'preco' => 'required',
                'descricaoCurta' => 'required',
                'descricaoDetalhada' => 'required',
                'genero' => 'required',
                'categoria' => 'required',
                //'imagen01' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                //'imagen02' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                //'imagen03' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                //'imagen04' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ], [
                'nome.required' => 'O campo nome é obrigatório!',
                'nome.min' => 'O nome deve conter no mínimo :min caracteres!',
                'quantidade.required' => 'O campo quantidade é obrigatório!',
                'preco.required' => 'O campo preco é obrigatório!',
                'descricaoCurta.required' => 'O campo descrição é obrigatório!',
                'descricaoDetalhada.required' => 'O campo descrição é obrigatório!',
                'genero.required' => 'Escolha um genero para o produto!',
                'categoria.required' => 'Escolha uma categoria para o produto!',
                //'imagen01.required' => 'A primeira imagem é obrigatória!',
            ]);

            $produto = Produtos::findOrFail($request->id);
            
            $produto->nome = $request->nome;
            $produto->quantidade = $request->quantidade;
            $produto->custo = $request->custo;
            $produto->preco = $request->preco;
            $produto->categoria_id = $request->categoria;
            $produto->genero_id = $request->genero;
            $produto->descricao_curta = $request->descricaoCurta;
            $produto->descricao_detalhada = $request->descricaoDetalhada;

            $produto->save();

            return redirect()->route('ar.produtos')->with(['produtoEditado' => 'Produto editado com suscesso!']);
        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }

    public function Banners()
    {
        if(Auth()->check())
        {
            $banners = Banners::all();

            return view('areaRestrita/ar_cadastroBanners', ['banners' => $banners]);

        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }

    public function SalvarBanner(Request $request)
    {
        if(Auth()->check())
        {
            $request->validate([
                'imagen01' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'imagen02' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'imagen01.required' => 'O banner de 1400 x 300 px é obrigatório!',
                'imagen02.required' => 'O banner de 768 x 300 px é obrigatório!',
            ]);

            

            $caminhoImagem1 = $request->imagen01->store('img/banners', 'public');
            $caminhoImagem2 = $request->imagen02->store('img/banners', 'public');
            Banners::Create([
                'maior_resolucao' => $caminhoImagem1,
                'menor_resolucao' => $caminhoImagem2,
            ]);

            $banners = Banners::all();
            return view('areaRestrita/ar_cadastroBanners', ['banners' => $banners])->with(['bannerAdd' => 'Banner adicionado com suscesso!']);;

        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }

    public function DeletarBanner($id)
    {
        if(Auth()->check())
        {
            $Banner = Banners::findOrFail($id);

            if (Storage::disk('public')->exists($Banner->menor_resolucao)) {
                Storage::disk('public')->delete($Banner->menor_resolucao);
            }
            if (Storage::disk('public')->exists($Banner->maior_resolucao)) {
                Storage::disk('public')->delete($Banner->maior_resolucao);
            }
            

            $Banner->delete();

            $banners = Banners::all();
            return view('areaRestrita/ar_cadastroBanners', ['banners' => $banners])->with(['bannerRemove' => 'Banner excluido com suscesso!']);;
        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }

    public function Categorias()
    {
        if(Auth()->check())
        {
            $categorias = Categorias::all();

            return view('areaRestrita/ar_cadastroCategoria', ['categorias' => $categorias]);

        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }

    public function SalvarCategoria(Request $request)
    {
        if(Auth()->check())
        {
            $request->validate([
                'categoria' => 'required'
            ], [
                'categoria.required' => 'O campo Nova Categoria é obrigatório!'
            ]);

        
            Categorias::Create([
                'descricao' => $request->categoria
            ]);

            $categorias = Categorias::all();
            return view('areaRestrita/ar_cadastroCategoria', ['categorias' => $categorias]);
        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }

    public function DeletarCategoria($id)
    {
        if(Auth()->check())
        {
            $produtos = Produtos::where('id', '=', $id)->get();

            if(count($produtos) === 0){
                $categoria = Categorias::findOrFail($id);
                $categoria->delete();
            }

            $categorias = Categorias::all();
            return view('areaRestrita/ar_cadastroCategoria', ['categorias' => $categorias]);
        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }
}
