@extends('layouts.default')

@section('title', ':: ' . $genero)

@section('foraContainer')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.7.0/nouislider.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.7.0/nouislider.min.js"></script>
    <div id="filtroMobile" class="hidden">
        <button id="closeButton" onclick="closeFiltro()">
            <svg class="bi me-2" width="40" height="40" style="fill: white;">
                <use xlink:href="{{ asset('site\bootstrap-icons.svg#arrow-left') }}"/>
            </svg>
        </button>
        <div class="menuEsquerdo">
                <div class="justify-content-center justify-content-md-start mb-3 mb-md-0">
                    @csrf
                    <h4>Busca por Nome</h4>
                    <div class="input-group input-group-sm">
                    <input id="filtroNomeSmall" name="nome" type="text" class="form-control" placeholder="Filtrar por nome" autocomplete="off">
                        <button class="btn btnBuscar" onclick="closeFiltro()">Buscar</button>
                    </div>
                </div>
                </br>
                <h4>Categorias</h4>
                <div>
                    @foreach($categorias as $categoria)
                        <input type="checkbox" id="{{ $categoria->id }}" 
                            name="{{ $categoria->id }}" value="{{ $categoria->id }}" class="categoria-checkbox">
                        <label for="{{ $categoria->id }}"> {{ $categoria->descricao }} </label><br>
                    @endforeach
                </div>
                </br>
                <h4>Faixa de Preço</h4>
                <div id="priceSliderSmall"></div>
                <div>
                    Valor Mínimo: <span id="minPriceSmall">0</span><br>
                    Valor Máximo: <span id="maxPriceSmall">500</span>
                </div>
            </div>
    </div>
@endsection
@section('content')
    <link rel="stylesheet" href={{ asset('css/produtos.css') }}>

    <div class="custon-bloco-start">
            <h3>{{ $genero }}</h3>
    </div>

    <div class="row">
        <div class="col-12 col-md-3 d-none d-md-block mx-auto"><!--Filtros tela grande-->
            <div class="menuEsquerdo">
                <div class="justify-content-center justify-content-md-start mb-3 mb-md-0">
                    @csrf
                    <h4>Busca por Nome</h4>
                    <div class="input-group input-group-sm">
                        <input id="filtroNomeLarge" name="nome" type="text" class="form-control" placeholder="Filtrar por nome" autocomplete="off">
                    </div>
                </div>
                </br>
                <h4>Categorias</h4>
                <form>
                    @foreach($categorias as $categoria)
                        <input type="checkbox" id="{{ $categoria->id }}" 
                            name="{{ $categoria->id }}" value="{{ $categoria->id }}" class="categoria-checkbox">
                        <label for="{{ $categoria->id }}"> {{ $categoria->descricao }} </label><br>
                    @endforeach
                </form>
                </br>
                <h4>Faixa de Preço</h4>
                <div id="priceSlider"></div>
                <div>
                    Valor Mínimo: <span id="minPrice">0</span><br>
                    Valor Máximo: <span id="maxPrice">500</span>
                </div>
                </br>
                </br>
                </br>
                </br>
                </br>
                </br>
            </div>
        </div>
        <div class="col-12 col-sm-8 col-md-9">
            <div class="container-fluid pl-0 pr-0"> <!--menu de ordenação-->
                <div class="row"> 
                    <div class="col-6 col-md-12 d-block d-md-none">
                        <div><!-- Botão para telas pequenas -->
                            <button class="btnFiltro">Filtrar Por</button>
                        </div>
                    </div>
                    <div class="col-6 col-md-12">
                        <div class="d-flex flex-row-reverse">
                            <div class="d-inline-block" id="formOrdenacao">
                                @csrf 
                                <select class="form-select form-select-sm" name="ordenacao" onchange="submitForm()">
                                    <option disabled selected hidden>Ordenar</option>
                                    <option value="0">Ordenar pelo nome</option>
                                    <option value="1">Ordenar pelo menor preço</option>
                                    <option value="2">Ordenar pelo maior preço</option>
                                    <option value="3">Ordenar pelo mais recente</option>
                                    <option value="4">Ordenar pelo mais antigo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid pl-0 pr-0"> <!--produtos-->
                <div id="containerProdutos" class="row g-5 custon-row">
                    @if(count($produtoscomImagens) > 0)
                        @foreach($produtoscomImagens as $produto)
                            <div class="col-xl-4 col-lg-4 col-md-4 col-6 produto" data-id="{{ $produto->id }}" data-nome="{{ $produto->nome }}" data-categoria="{{ $produto->categoria_id }}" data-preco="{{ $produto->preco }}" data-data="{{ $produto->created_at }}">
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
                    @else
                        <h4>Nenhum produto encontrado :(</h4>
                    @endif
                </div>
            </div>
            <div> <!--espaço fim de página-->
                </br>
                </br>
                </br>
                </br>
                </br>
                </br>
            </div>
        </div>
    </div>
    <script src={{ asset('js/filtroProdutos.js') }}></script>

@endsection

