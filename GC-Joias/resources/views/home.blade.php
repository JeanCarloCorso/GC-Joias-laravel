@extends('layouts.default')

@section('title', ':: Home')

@section('content')
    <link rel="stylesheet" href={{ asset('css/estilos.css') }}>

    <div class="row g-3">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 d-flex align-items-stretch">
            <div class="card text-center bg-light">
                <a href="#" class="position-absolute end-0 p-2 text-danger">
                    <i class="bi-suit-heart" style="font-size: 24px; line-height: 24px;"></i>
                </a>
                <img src={{ asset('site/img/produtos/produto01.jpg') }} class="card-img-top">
                <div class="card-header">
                    R$ 9,99
                </div>
                <div class="card-body">
                    <h5 class="card-title">Produto 01</h5>
                    <p class="card-text truncar-3l">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a est ut velit scelerisque malesuada. Morbi est velit, tristique congue augue eget, aliquam laoreet dui. .
                    </p>
                </div>
                <div class="card-footer">
                    <a href="carrinho.html" class="btn btn-danger mt-2 d-block">
                        Adicionar ao Carrinho
                    </a>
                    <small class="text-success">1 em estoque</small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 d-flex align-items-stretch">
            <div class="card text-center bg-light">
                <a href="#" class="position-absolute end-0 p-2 text-danger">
                    <i class="bi-suit-heart" style="font-size: 24px; line-height: 24px;"></i>
                </a>
                <img src={{ asset('site/img/produtos/produto02.jpg') }} class="card-img-top">
                <div class="card-header">
                    R$ 9,99
                </div>
                <div class="card-body">
                    <h5 class="card-title">Produto 02</h5>
                    <p class="card-text truncar-3l">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a est ut velit scelerisque malesuada. Morbi est velit, tristique congue augue eget, aliquam laoreet dui. .
                    </p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-light disabled mt-2 d-block">
                        <small>Reabastecendo Estoque</small>
                    </a>
                    <small class="text-danger">
                        <b>Produto Esgotado</b>
                    </small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 d-flex align-items-stretch">
            <div class="card text-center bg-light">
                <a href="#" class="position-absolute end-0 p-2 text-danger">
                    <i class="bi-suit-heart" style="font-size: 24px; line-height: 24px;"></i>
                </a>
                <img src={{ asset('site/img/produtos/produto03.jpg') }} class="card-img-top">
                <div class="card-header">
                    R$ 9,99
                </div>
                <div class="card-body">
                    <h5 class="card-title">Produto 03</h5>
                    <p class="card-text truncar-3l">
                        Descrição do produto 03.
                    </p>
                </div>
                <div class="card-footer">
                    <a href="carrinho.html" class="btn btn-danger mt-2 d-block">
                        Adicionar ao Carrinho
                    </a>
                    <small class="text-success">4 em estoque</small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 d-flex align-items-stretch">
            <div class="card text-center bg-light">
                <a href="#" class="position-absolute end-0 p-2 text-danger">
                    <i class="bi-suit-heart" style="font-size: 24px; line-height: 24px;"></i>
                </a>
                <img src={{ asset('site/img/produtos/produto01.jpg') }} class="card-img-top">
                <div class="card-header">
                    R$ 9,99
                </div>
                <div class="card-body">
                    <h5 class="card-title">Produto 01</h5>
                    <p class="card-text truncar-3l">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a est ut velit scelerisque malesuada. Morbi est velit, tristique congue augue eget, aliquam laoreet dui. .
                    </p>
                </div>
                <div class="card-footer">
                    <a href="carrinho.html" class="btn btn-danger mt-2 d-block">
                        Adicionar ao Carrinho
                    </a>
                    <small class="text-success">5 em estoque</small>
                </div>
            </div>
        </div>
        
    </div>
@endsection
