@extends('layouts.default')

@section('title', ':: Home')

@section('content')
    <link rel="stylesheet" href={{ asset('css/estilos.css') }}>

    <div class="row g-3">
        @foreach($produtoscomImagens as $produto)
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
                <div class="card text-center bg-light">
                    <a href="#" class="position-absolute end-0 p-2 text-danger">
                        <i class="bi-suit-heart" style="font-size: 24px; line-height: 24px;"></i>
                    </a>
                    <img src="{{ asset('site/img/produtos/' . $produto->imagens[0]->nome) }}" class="card-img-top">
                    <div class="card-header">
                        R$ {{ $produto->preco }}
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">{{ $produto->nome }}</h6>
                        <p class="card-text truncar-3l">
                            {{ $produto->descricao }}
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="carrinho.html" class="btn btn-danger mt-2 d-block">
                            Adicionar ao Carrinho
                        </a>
                        <small class="text-success">{{ $produto->quantidade }} em estoque</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
