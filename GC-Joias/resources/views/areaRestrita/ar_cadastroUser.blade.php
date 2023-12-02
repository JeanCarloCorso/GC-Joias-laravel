@extends('layouts.arearestrita')

@section('nomeUser', auth()->user()->name )

@section('content')
    
    <link rel="stylesheet" href={{ asset('css/estilos.css') }}>

    <form class="col-8" method="post" action="{{ route('ar.criar.user') }}">
        @csrf
        <h1>Novo Usuário</h1>

        <div class="form-floating mb-3">
            <input type="text" id="txtNome" class="form-control" name="nome" placeholder=" " autofocus>
            <label for="txtNome">Nome Completo</label>
        </div>

        <div class="form-floating mb-3">
            <input type="email" id="txtEmail" class="form-control" name="email" placeholder=" ">
            <label for="txtEmail">E-mail</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" id="txtSenha" class="form-control" name="password" placeholder=" ">
            <label for="txtSenha">Senha</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" id="txtConfSenha" class="form-control" name="passwordConfirm" placeholder=" ">
            <label for="txtConfSenha">Confirme a Senha</label>
        </div>

        <button type="submit" class="btn btn-lg btn-danger">Cadastrar Usuário</button>
    </form>

    <div class="notification-container top-right">
        @if ($errors->has('nome'))
            <div class="error-notification larger">{{ $errors->first('nome') }}</div>
        @endif
        @if ($errors->has('email'))
            <div class="error-notification larger">{{ $errors->first('email') }}</div>
        @endif
        @if ($errors->has('password'))
            <div class="error-notification larger">{{ $errors->first('password') }}</div>
        @endif
        @if ($errors->has('passwordConfirm'))
            <div class="error-notification larger">{{ $errors->first('passwordConfirm') }}</div>
        @endif
        @if ($errors->has('usuarioExistente'))
            <div class="error-notification larger">{{ $errors->first('usuarioExistente') }}</div>
        @endif
    </div>

@endsection