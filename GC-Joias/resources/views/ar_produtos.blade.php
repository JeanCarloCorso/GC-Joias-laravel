@extends('layouts.arearestrita')

@section('nomeUser', $user )

@section('content')
    
    <link rel="stylesheet" href={{ asset('css/estilos.css') }}>
    
    <form class="justify-content-center justify-content-md-start mb-3 mb-md-0" method="post" action="{{ route('filtra.produto.nome') }}">
        @csrf
        <div class="input-group input-group-sm">
            <input name="nome" type="text" class="form-control" placeholder="Digite aqui o que procura">
            <button class="btn btn-danger" type="submit">Buscar</button>
        </div>
    </form>

    <br/>

    <div class="row">
        @if(count($produtos) > 0)
            @foreach($produtos as $produto)

                <ul class="list-group mb-3">
                    <li class="list-group-item py-3">
                        <div class="row g-3">
                            <div class="col-4 col-md-3 col-lg-2">
                                <a href="#">
                                    <img src="{{ asset('site/img/produtos/' . $produto->imagens[0]->nome) }}" class="img-thumbnail">
                                </a>
                            </div>
                            <div class="col-8 col-md-9 col-lg-7 col-xl-8 text-left align-self-center">
                                <h6 class="truncar-2l">
                                    <b><a href="#" class="text-decoration-none text-danger">
                                        {{ $produto->nome }}</a></b>
                                </h6>

                                <p class="truncar-2l">{{ $produto->descricao }}</p>
                            </div>
                            <div
                                class="col-6 offset-6 col-sm-6 offset-sm-6 col-md-4 offset-md-8 col-lg-3 offset-lg-0 col-xl-2 align-self-center mt-3">
                                <div class="input-group">
                                    <button class="btn btn-outline-dark btn-sm custon-tamanho-btn" type="button">
                                        <svg class="bi me-2" width="20" height="20">
                                            <use xlink:href="{{ asset('site\bootstrap-icons.svg#pencil') }}"/>
                                        </svg> Editar
                                    </button>
                                    <button class="btn btn-outline-danger border-dark btn-sm custon-tamanho-btn" type="button">
                                        <svg class="bi me-2" width="20" height="20">
                                            <use xlink:href="{{ asset('site\bootstrap-icons.svg#trash') }}"/>
                                        </svg> Apagar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            @endforeach
        @else
            <h3>Nenhum produto encontrado :(</h3>
        @endif
    </div>

@endsection