<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href={{ asset('site/bootstrap.min.css') }}> 
    

    <title>GC Jóias @yield('title', '')</title>

    <link rel="icon" type="image/x-icon" href={{ asset('site//img/favicon/favicon.ico') }}>
    
</head>

<body style="min-width: 372px;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger border-bottom shadow-sm mb-3">
        <div class="container">
            <a class="navbar-brand" href="/"><b>GC Jóias</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav flex-grow-1">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/index.html">Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/contato.html">Contato</a>
                    </li>
                </ul>
                <div class="align-self-end">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/cadastro.html" class="nav-link text-white">Quero Me Cadastrar</a>
                        </li>
                        <li class="nav-item">
                            <a href="/login.html" class="nav-link text-white">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white">
                                <svg class="bi" width="24" height="24" fill="currentColor">
                                    <use xlink:href={{ asset('site/bootstrap-icons.svg#cart3') }} />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <header class="container">
        <div id="carouselMain" class="carousel slide carousel-dark" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="3000">
                    <img src={{ asset('site//img/slides/slide01.jpg') }} class="d-none d-md-block w-100" alt="">
                    <img src={{ asset('site//img/slides/slide01small.jpg') }} class="d-block d-md-none  w-100" alt="">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src={{ asset('site//img/slides/slide01.jpg') }} class="d-none d-md-block w-100" alt="">
                    <img src={{ asset('site//img/slides/slide01small.jpg') }} class="d-block d-md-none  w-100" alt="">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src={{ asset('site//img/slides/slide01.jpg') }} class="d-none d-md-block w-100" alt="">
                    <img src={{ asset('site//img/slides/slide01small.jpg') }} class="d-block d-md-none  w-100" alt="">
                </div>
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

    <main class="flex-fill">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-5">
                    <form class="justify-content-center justify-content-md-start mb-3 mb-md-0">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Digite aqui o que procura">
                            <button class="btn btn-danger">Buscar</button>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-7">
                    <div class="d-flex flex-row-reverse justify-content-center justify-content-md-start">
                        <form class="d-inline-block">
                            <select class="form-select form-select-sm">
                                <option>Ordenar pelo nome</option>
                                <option>Ordenar pelo menor preço</option>
                                <option>Ordenar pelo maior preço</option>
                            </select>
                        </form>
                        <nav class="d-inline-block me-3">
                            <ul class="pagination pagination-sm my-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">4</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">5</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">6</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <hr class="mt-3">
            
            @yield('content')

        <hr class="mt-3">

        <div class="row pb-3">
            
            <div class="col-12">
                <div class="d-flex flex-row-reverse justify-content-center">
                    <nav class="d-inline-block me-3">
                        <ul class="pagination pagination-sm my-0">
                            <li class="page-item">
                                <a class="page-link" href="#">Anterior</a>
                            </li>
                            <li class="page-item disabled">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">4</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">5</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">6</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Próxima</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </main>

    <footer class="border-top text-muted bg-light">
        <div class="container">
            <div class="row py-3">
                <div class="col-12 col-md-4 text-center">
                    &copy; 2023 - GC Jóias<br>
                </div>
                <div class="col-12 col-md-4 text-center">
                    <a href="/privacidade.html" class="text-decoration-none text-dark">
                        Política de Privacidade
                    </a><br>
                    <a href="/termos.html" class="text-decoration-none text-dark">
                        Termos de Uso
                    </a><br>
                    <a href="/quemsomos.html" class="text-decoration-none text-dark">
                        Quem Somos
                    </a><br>
                    <a href="/trocas.html" class="text-decoration-none text-dark">
                        Trocas e Devoluções
                    </a>
                </div>
                <div class="col-12 col-md-4 text-center">
                    <a href="/contato.html" class="text-decoration-none text-dark">
                        Contato pelo Site
                    </a><br>
                    E-mail: <a href="mailto:email@dominio.com" class="text-decoration-none text-dark">
                        email@dominio.com
                    </a><br>
                    Telefone: <a href="phone:28999990000" class="text-decoration-none text-dark">
                        (28) 99999-0000
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