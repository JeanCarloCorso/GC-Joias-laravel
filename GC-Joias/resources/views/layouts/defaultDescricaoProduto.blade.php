<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href={{ asset('site/bootstrap.min.css') }}> 
    
    <link rel="stylesheet" href={{ asset('css/estilos.css') }}>
    <title>GC Jóias @yield('title', '')</title>

    <link rel="icon" type="image/x-icon" href={{ asset('site/img/favicon/favicon.ico') }}>
    
</head>

<body style="min-width: 372px;">
    <!--navebar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger border-bottom shadow-sm mb-3">
        <div class="container">
            <a class="navbar-brand" href="/"><b>GC Jóias</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto"> 
                    <li class="nav-item">
                        <a href="/" class="nav-link text-white">Início</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('contato.show') }}" class="nav-link text-white">Contato pelo Site</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-fill">
        <div class="container-fluid">

            @yield('content')

        </div>
    </main>

    <footer class="border-top text-muted bg-light">
        <div class="container">
            <div class="row py-3">
                <div class="col-12 col-md-4 text-center">
                    &copy; 2023 - GC Jóias<br>
                </div>
                <div class="col-12 col-md-4 text-center">
                    <a href="{{ route('privacidade.show') }}" class="text-decoration-none text-dark">
                        Política de Privacidade
                    </a><br>
                    <a href="{{ route('termos.show') }}" class="text-decoration-none text-dark">
                        Termos de Uso
                    </a><br>
                    <a href="{{ route('quemsomos.show') }}" class="text-decoration-none text-dark">
                        Quem Somos
                    </a>
                </div>
                <div class="col-12 col-md-4 text-center">
                    <a href="{{ route('contato.show') }}" class="text-decoration-none text-dark">
                        Contato pelo Site
                    </a><br>
                    E-mail: <a href="{{ config('app.email') }}" class="text-decoration-none text-dark">
                        {{ config('app.email') }}
                    </a><br>
                    Telefone: <a href="phone:{{ config('app.telefone') }}" class="text-decoration-none text-dark">
                        {{ config('app.telefone') }}
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src={{ asset('site/bootstrap.bundle.js') }}></script>
</body>

</html>