<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AreaRestritaController extends Controller
{
    public function ProdutosAr(Request $request)
    {
        if(Auth()->check())
        {
            $produtos = Produtos::whereHas('imagens')->where('quantidade', '>', 0)
                ->orderBy('nome', 'asc')->get();
            $user = 'Jean Carlo Corso';

            return view('areaRestrita/ar_produtos', ['user' => $user, 'produtos' => $produtos]);
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
}
