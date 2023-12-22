@extends('layouts.default')

@section('title', ':: Contato')

@section('content')
<link rel="stylesheet" href={{ asset('css/contato.css') }}>
    <div class="row justify-content-center custon-row">
        <form class="col-sm-10 col-md-8 col-lg-6" method="post" action="{{ route('salvaNovaMensagem') }}">
            @csrf
            <div class="custon-bloco-start">
                <h1 class="custon">Entre em Contato</h1>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="nome" id="txtNomeCompleto" class="form-control" placeholder=" " autofocus>
                <label for="txtNomeCompleto">Nome Completo</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" id="txtEmail" name="email" class="form-control" placeholder=" ">
                <label for="txtEmail">E-mail</label>
            </div>

            <div class="form-floating mb-3">
                <textarea id="txtMensagem" name="mensagem" class="form-control" placeholder=" "
                    style="height: 200px;"></textarea>
                <label for="txtMensagem">Mensagem</label>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-lg btn-custon w-100">Enviar Mensagem</button>
            </div>

            <p class="mt-3">
                Faremos nosso melhor para responder sua mensagem em até 2 dias úteis.
            </p>

            <p class="mt-3">
                Atenciosamente,<br>
                Central de Relacionamento GC Jóias
            </p>
        </form>

            <div class="notification-container top-right">
            @if ($errors->has('nome'))
                <div class="error-notification larger">{{ $errors->first('nome') }}</div>
            @endif
            @if ($errors->has('email'))
                <div class="error-notification larger">{{ $errors->first('email') }}</div>
            @endif
            @if ($errors->has('mensagem'))
                <div class="error-notification larger">{{ $errors->first('mensagem') }}</div>
            @endif
        </div>

    </div>
@endsection