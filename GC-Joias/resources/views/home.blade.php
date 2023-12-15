@extends('layouts.default')

@section('title', ':: Home')

@section('content')
    <link rel="stylesheet" href={{ asset('css/estilos.css') }}>

    <!--banner-->
    <header class="container">
        <div id="carouselMain" class="carousel slide carousel-dark" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @php
                    $contador = 0;
                    $ativo = "class=\"active\"";
                @endphp

                @foreach($banners as $banner)
                    <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="{{ $contador }}" class="active"></button>
                    @php
                        $contador++;
                        $ativo = "";
                    @endphp
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach($banners as $banner)
                    <div class="carousel-item active" data-bs-interval="3000">
                        <img src="{{ asset('storage/' . $banner->maior_resolucao ) }}" class="d-none d-md-block w-100" alt="">
                        @if($banner->menor_resolucao === "")
                            <img src="{{ asset('storage/' . $banner->maior_resolucao ) }}" class="d-block d-md-none  w-100" alt="">
                        @else
                            <img src="{{ asset('storage/' . $banner->menor_resolucao ) }}" class="d-block d-md-none  w-100" alt="">
                        @endif
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselMain" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselMain" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Próximo</span>
            </button>
            <hr class="mt-3">
        </div>
    </header>

    <!--Busca + ordenar-->
    <div class="row">
                <!--Busca-->
                <div class="col-12 col-md-5">
                    <form class="justify-content-center justify-content-md-start mb-3 mb-md-0" method="post" action="{{ route('filtra.produto.nome') }}">
                        @csrf
                        <div class="input-group input-group-sm">
                            <input name="nome" type="text" class="form-control" placeholder="Digite aqui o que procura">
                            <button class="btn btn-danger" type="submit">Buscar</button>
                        </div>
                    </form>
                </div>

                <!--filtros-->
                <div class="col-12 col-md-7">
                    <div class="d-flex flex-row-reverse justify-content-center justify-content-md-start">
                        <form class="d-inline-block" id="formOrdenacao" method="post" action="{{ route('ordena.produto') }}">
                            @csrf <!-- Adicione o token CSRF -->
                            <select class="form-select form-select-sm" name="ordenacao" onchange="submitForm()"> <!-- Adicione onchange para chamar a função JS -->
                                <option disabled selected hidden>Ordenar</option>
                                <option value="0">Ordenar pelo nome</option>
                                <option value="1">Ordenar pelo menor preço</option>
                                <option value="2">Ordenar pelo maior preço</option>
                                <option value="3">Ordenar pelo mais recente</option>
                                <option value="4">Ordenar pelo mais antigo</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <hr class="mt-1">

    <!--Listagem de Produtos-->
    @if(count($produtoscomImagens) > 0)
        <div class="row g-3 justify-content-center">
            @foreach($produtoscomImagens as $produto)
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 d-flex align-items-stretch mb-4">
                    <div class="card text-center bg-light">
                        <a href="#" class="position-absolute end-0 p-2 text-danger">
                            <i class="bi-suit-heart" style="font-size: 24px; line-height: 24px;"></i>
                        </a>
                        <img src="{{ asset('storage/' . $produto->imagens[0]->path) }}" class="card-img-top">
                        <div class="card-header">
                            R$ {{ number_format($produto->preco, 2, ',', '.') }}
                        </div>
                        <div class="card-body">
                            <h6 class="card-title truncar-2l">{{ $produto->nome }}</h6>
                            <p class="card-text truncar-3l">
                                {{ $produto->descricao_curta }}
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('produto.detalhes', ['id' => $produto->id]) }}" class="btn btn-danger mt-2 d-block">
                                Ver Detalhes
                            </a>
                            <small class="text-success">{{ $produto->quantidade }} em estoque</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h3>Nenhum produto encontrado :(</h3>
    @endif
    <!--paginacao quando for implementada -->
    <hr class="mt-3">
    
@endsection

<script>
    function submitForm() {
        document.getElementById("formOrdenacao").submit();
    }
</script>