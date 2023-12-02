@extends('layouts.arearestrita')

@section('nomeUser', auth()->user()->name )

@section('content')
    
    <link rel="stylesheet" href={{ asset('css/estilos.css') }}>

    <form class="col-8" method="post" action="{{ route('ar.salvaSenha') }}">
        @csrf
        <h1>Alterar Senha</h1>

        <div class="form-floating mb-3">
            <input type="password" id="txtSenha" class="form-control" name="password" placeholder=" ">
            <label for="txtSenha">Nova Senha</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" id="txtConfSenha" class="form-control" name="passwordConfirm" placeholder=" ">
            <label for="txtConfSenha">Confirme a Senha</label>
        </div>

        <button type="submit" class="btn btn-lg btn-danger">Alterar Senha</button>
    </form>

    <div class="notification-container top-right">
        @if ($errors->has('passwordConfirm'))
            <div class="error-notification larger">{{ $errors->first('passwordConfirm') }}</div>
        @endif
        @if ($errors->has('password'))
            <div class="error-notification larger">{{ $errors->first('password') }}</div>
        @endif
    </div>

@endsection