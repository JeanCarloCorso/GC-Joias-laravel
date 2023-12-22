@extends('layouts.default')

@section('title', ':: Home')

@section('carrousel')
    <link rel="stylesheet" href={{ asset('css/estilos.css') }}>
    <link rel="stylesheet" href={{ asset('css/home.css') }}>

    <!--banner-->
    <header>
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
                    <div class="carousel-item active magem-container" data-bs-interval="3000">
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
        </div>
    </header>
@endsection

@section('content')

    <!--Exibe as categorias-->
    <div class="custon-bloco">
        <h3>CATEGORIAS</h3>
        <div class="row g-4 justify-content-center custon-row">
            <div class="col-12 col-md-4">
                <a href="/categoria/mulher" class="categoria-link">
                    <div class="categoria-container mulher">
                        <div class="texto">
                            <span style="font-size: 2em;">MULHERES</span></br>
                            <span>{{ $qtdProdutosFemininos }} Produtos</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-4">
                <a href="/categoria/homem" class="categoria-link">
                    <div class="categoria-container homem">
                        <div class="texto">
                            <span style="font-size: 2em;">HOMENS</span></br>
                            <span>{{ $qtdProdutosMasculinos }} Produtos</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!--Exibe os mais recentes-->
    @if(count($produtoscomImagens) > 0)
        <div class="custon-bloco">
            <h3>PRODUTOS EM DESTAQUE</h3>
            <div class="row g-3 justify-content-center custon-row">
                @foreach($produtoscomImagens as $produto)
                    <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                        <a href="{{ route('produto.detalhes', ['id' => $produto->id]) }}" class="btn mt-2 d-block">
                            <div class="card text-center bg-light">
                                <img src="{{ asset('storage/' . $produto->imagens[0]->path) }}" class="card-img-top">
                            </div>
                            <div>
                                <span class="custom-span truncar-1l">{{ $produto->nome }}</span>
                                <span class="custom-span span-preco">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="row g-3 custon-row-sobre justify-content-center" style="background-color: white; margin-bottom: 50px;">
        <form class="col-sm-10 col-md-8 col-lg-6" method="post" action="{{ route('salvaNovaMensagem') }}">
            @csrf
            <div class="custon-bloco">
                <h3>CONTATO</h3><br>
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
        </form>
    </div>
    
    <script src={{ asset('js/home.js') }}></script> 
@endsection

