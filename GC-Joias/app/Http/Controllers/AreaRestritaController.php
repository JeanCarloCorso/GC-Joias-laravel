<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Generos;
use App\Models\ImagemProdutos;
use App\Models\Produtos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
                'descricao' => 'required',
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
                'descricao.required' => 'O campo descrição é obrigatório!',
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
                'descricao' => $request->descricao,
            ]);

            if ($request->hasFile('imagen01')) {
                $imagem = $request->file('imagen01');
                $nomeImagem = time() . '_' . $imagem->getClientOriginalName();
                $caminhoImagem = $imagem->storeAs('public/site/img/produtos', $nomeImagem);
                ImagemProdutos::create([
                    'produto_id' => $novoProduto->id,
                    'nome' => $nomeImagem,
                    'principal' => true
                ]);
            }

            return redirect()->route('ar.produtos')->with(['produtoCadastrado' => 'Produto cadastrado com suscesso!']);
        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }
}
