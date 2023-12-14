@extends('layouts.defaultDescricaoProduto')

@section('content')
    <link rel="stylesheet" href={{ asset('css\estilosPaginaDetalheProduto.css') }}>
     
     <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 imagens-block">
            <div class="row">
                <div class="col-2">
                    <div id="thumbnails">
                        @foreach($produto->imagens as $imagem)
                            <img src="{{ asset('storage/' . $imagem->path) }}" class="thumbnail img-fluid" data-full="{{ asset('storage/' . $imagem->path) }}">
                        @endforeach
                    </div>
                </div>

                <div class="col-10">
                    <img src="{{ asset('storage/' . $produto->imagens[0]->path) }}" class="main-image img-fluid" alt="Imagem Principal">
                </div>
            </div>
        </div>

        <!-- Segundo bloco -->
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 product-block-info">
            <div class="text-block">
                <!-- Conteúdo do segundo bloco -->
                <h1 class="product-meta__title heading h1"> {{ $produto->nome }} <span class="verification__stamp"></span></h1>
                <p>{{ $produto->descricao_curta }}</p>
                <hr class="mt-3">
                <div class="row">
                    <div class="col-6">
                        <p>Apenas {{ $produto->quantidade }} unidades em estoque!</p>
                        <p>Garanta o seu por apenas:</p>
                        <h4>R$ {{ number_format($produto->preco, 2, ',', '.') }}</h4>
                    </div>
                    <div class="col-6">
                        <p>Aproveite nossos preços e</p>
                        <a href="https://wa.me/{{ config('app.telefoneNumero') }}?text=Olá,%20Gostaria%20de%20obter%20mais%20informações%20sobre%20o%20produto%20*{{$produto->nome}}*!" target="_blank">
                            <button class="whatsapp-button">Garanta o Seu</button>
                        </a>
                    </div>
                </div>
            </div>
        </br>
        </div>

        <div class="col-12">
            <div class="text-block">
                <!-- Conteúdo do terceiro bloco -->
                {!! $produto->descricao_detalhada !!}
            </div>
        </div>
    </div>
    </br>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Quando uma miniatura for clicada
            $('.thumbnail').click(function() {
                // Atualizar a imagem principal com a imagem clicada
                var fullImageUrl = $(this).data('full');
                $('.main-image').attr('src', fullImageUrl);
            });
        });
    </script>
    
@endsection