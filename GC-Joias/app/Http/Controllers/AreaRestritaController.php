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

            return view('ar_produtos', ['user' => $user, 'produtos' => $produtos]);
        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }

    public function CriaUser()
    {
        $new = [
            'name' => 'Jean Carlo Corso',
            'email' => 'email@dominio.com',
            'password' => '1234567890',
        ];

        $new['password'] = Hash::make('1234567890');

        $user = User::create($new);
        dd($user);
        // Redirecione ou retorne uma resposta adequada após a criação do usuário
    }
}
