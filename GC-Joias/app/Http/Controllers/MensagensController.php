<?php

namespace App\Http\Controllers;

use App\Models\Mensagens;
use Illuminate\Http\Request;

class MensagensController extends Controller
{
    public function SalvarMensagem(Request $request)
    {
        $request->validate([
            'nome' => 'required|min:3',
            'email' => 'required|email',
            'mensagem' => 'required',
        ], [
            'nome.required' => 'O campo Nome Completo é obrigatório!',
            'nome.min' => 'O seu nome deve conter no mínimo :min caracteres!',
            'email.required' => 'O campo E-mail é obrigatório!',
            'mensagem.required' => 'O campo Mensagem é obrigatório!',
        ]);

        Mensagens::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'mensagem' => $request->mensagem,
            'respondida' => false
        ]);

        return redirect()->route('confirmacaoMensagem');
    }

    public function Mensagens()
    {
        if(Auth()->check())
        {
            $mensagens = Mensagens::orderBy('created_at')->get();

            return view('areaRestrita/ar_centralMensagens', ['mensagens' => $mensagens]);
        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }

    public function MarcarLidaNaoLida($id)
    {
        if(Auth()->check())
        {
            $mensagem = Mensagens::findOrFail($id);
            if($mensagem->respondida)
            {
                $mensagem->respondida = false;
            }
            else
            {
                $mensagem->respondida = true;
            }

            $mensagem->save();
            return redirect()->route('ar.mensagens');
        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }

    public function OrdenarMensagens(Request $request)
    {
        if(Auth()->check())
        {
            $ordenacao = $request->input('ordenacao');

            $mensagens = Mensagens::query();

            switch ($ordenacao) 
            {
                case '1':
                    $mensagens->where('respondida', '=', true);
                    break;
                case '2':
                    $mensagens->where('respondida', '=', false);
                    break;
                default:
                    return redirect()->route('ar.mensagens');
                    break;
            }
            $mensagens = $mensagens->get();
            return view('areaRestrita/ar_centralMensagens', ['mensagens' => $mensagens]);
        }
        else
        {
            return redirect()->route('login.index')->withErrors(['naoLogado' => 'Login necessário!']);
        }
    }

}
