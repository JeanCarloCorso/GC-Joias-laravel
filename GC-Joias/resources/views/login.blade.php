@extends('layouts.default')

@section('title', ':: Privacidade')

@section('content')
    <form class="col-sm-10 col-md-8 col-lg-6" method="post" action="{{ route('ar.produtos') }}">
        @csrf
        <h1>Identifique-se, por favor</h1>

        <div class="form-floating mb-3">
            <input type="email" id="txtEmail" class="form-control" placeholder=" " autofocus>
            <label for="txtEmail">E-mail</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" id="txtSenha" class="form-control" placeholder=" ">
            <label for="txtSenha">Senha</label>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" value="" id="chkLembrar">
            <label for="chkLembrar" class="form-check-label">Lembrar de mim</label>
        </div>

        <button type="submit" class="btn btn-lg btn-danger">Entrar</button>

        <p class="mt-3">
            Se tiver problemas ao efetuar login, entre em contato com o administrador do sistema!
        </p>

        <br/>
    </form>
@endsection