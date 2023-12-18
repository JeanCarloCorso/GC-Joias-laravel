<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href={{ asset('site/bootstrap.min.css') }}> 
    <link rel="stylesheet" href={{ asset('css/newlayout.css') }}>

    <title>GC Jóias @yield('title', '')</title>

    <link rel="icon" type="image/x-icon" href={{ asset('site/img/favicon/favicon.ico') }}>
    
</head>

<body style="background-color: #F9F9F9;">
    <!--navebar dispositivos grandes-->
    <nav class="navbar navbar-expand-lg navbar-dark border-bottom custom-nav shadow-sm mb-3 d-lg-block d-none">
        <div class="container">
            <a class="navbar-brand custom-navbar-brand" href="/">
                <img src="/site/img/logo/logo.png" alt="Logo" class="logo-image">
                <b>GC Jóias</b>
            </a>
            <div>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="/" class="nav-link text-white">Início</a>
                    </li>
                    <li class="nav-item">
                        <a href="/" class="nav-link text-white">Mulheres</a>
                    </li>
                    <li class="nav-item">
                        <a href="/" class="nav-link text-white">Homens</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('quemsomos.show') }}" class="nav-link text-white">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('contato.show') }}" class="nav-link text-white">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--navebar dispositivos pequenos-->
    <nav class="navbar navbar-expand-lg navbar-dark border-bottom custom-nav shadow-sm mb-3 d-lg-none">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center w-100">
                <a class="menuHamburger" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </a>
                <a class="navbar-brand custom-navbar-brand" href="/">
                    <img src="/site/img/logo/logo.png" alt="Logo" class="logo-image">
                    <b>GC Jóias</b>
                </a>
                <div></div>
            </div>
        </div>
    </nav>

    <!--Menu opções da nav para dispositivos pequenos-->
    <div id="navMobile" class="hidden">
        <button id="closeButton" onclick="closeNav()">
            <svg class="bi me-2" width="40" height="40" style="fill: white;">
                <use xlink:href="{{ asset('site\bootstrap-icons.svg#x') }}"/>
            </svg>
        </button>
        <ul>
            <li><a href="/">Início</a></li>
            <li><a href="/">Mulheres</a></li>
            <li><a href="/">Homens</a></li>
            <li><a href="{{ route('quemsomos.show') }}">Sobre</a></li>
            <li><a href="{{ route('contato.show') }}">Contato</a></li>
        </ul>
    </div>

    <div class="content-below-nav">
        @yield('carrousel')
    </div>
    <div class="container-fluid">
        @yield('content')
    </div>
  
    <footer class="border-top" style="background-color: #171825; color: white;">
        <div class="container">
            <div class="row py-3">
                <div class="slide1 col-12 col-md-4 text-center">
                    &copy; 2023 - Copyright CorsoSoftwares<br>
                </div>
                <div class="slide2 col-12 col-md-4 text-center">
                    <a href="{{ route('privacidade.show') }}" class="text-decoration-none text-white">
                        Política de Privacidade
                    </a><br>
                    <a href="{{ route('termos.show') }}" class="text-decoration-none text-white">
                        Termos de Uso
                    </a><br>
                    <a href="{{ route('quemsomos.show') }}" class="text-decoration-none text-white">
                        Quem Somos
                    </a>
                </div>
                <div class="slide3 col-12 col-md-4 text-center">
                    <a href="{{ route('contato.show') }}" class="text-decoration-none text-white">
                        Contato pelo Site
                    </a><br>
                    E-mail: <a href="{{ config('app.email') }}" class="text-decoration-none text-white">
                        {{ config('app.email') }}
                    </a><br>
                    Telefone: <a href="phone:{{ config('app.telefone') }}" class="text-decoration-none text-white">
                        {{ config('app.telefone') }}
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src={{ asset('js/navPrincipal.js') }}></script>
    <script src={{ asset('site/bootstrap.bundle.js') }}></script>
</body>

</html>