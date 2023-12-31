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

    <link rel="icon" type="image/x-icon" href={{ asset('site//img/favicon/favicon.ico') }}>

</head>

<body style="min-width: 372px;">
    <nav class="navbar navbar-expand-lg navbar-dark border-bottom custom-nav shadow-sm mb-3">
        <div class="container">
            <a class="navbar-brand custom-navbar-brand" href="/">
                <img src="/site/img/logo/logo.png" alt="Logo" class="logo-image">
                <b>GC Jóias</b>
            </a>
            <div class="align-self-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white">Bem-vindo,&nbsp;@yield('nomeUser', 'Usuário')</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-fill">
        <div class="container-fluid content-below-nav-ar">
            <h3>Área Restrita</h3>
            <div class="row gx-3">
                <div class="col-4">
                    <div class="list-group">
                        <a href="{{ route('login.store') }}" class="list-group-item list-group-item-action">
                            <svg class="bi me-2" width="20" height="20">
                                <use xlink:href="{{ asset('site\bootstrap-icons.svg#folder') }}"/></svg> Listar Produtos
                        </a>
                        <a href="{{ route('ar.cadastroProduto') }}" class="list-group-item list-group-item-action">
                            <svg class="bi me-2" width="20" height="20">
                                <use xlink:href="{{ asset('site\bootstrap-icons.svg#plus-circle') }}"/></svg> Cadastrar Produto
                        </a>
                        <a href="{{ route('ar.categorias') }}" class="list-group-item list-group-item-action">
                            <svg class="bi me-2" width="20" height="20">
                                <use xlink:href="{{ asset('site\bootstrap-icons.svg#grid') }}"/></svg> Categorias
                        </a>
                        <a href="{{ route('ar.banners') }}" class="list-group-item list-group-item-action">
                            <svg class="bi me-2" width="20" height="20">
                                <use xlink:href="{{ asset('site\bootstrap-icons.svg#play') }}"/></svg> Banner
                        </a>
                        <a href="{{ route('ar.mensagens') }}" class="list-group-item list-group-item-action">
                            <svg class="bi me-2" width="20" height="20">
                                <use xlink:href="{{ asset('site\bootstrap-icons.svg#mailbox') }}"/></svg> Mensagens
                        </a>
                        <a href="{{ route('ar.cadastro.user') }}" class="list-group-item list-group-item-action">
                            <svg class="bi me-2" width="20" height="20">
                                <use xlink:href="{{ asset('site\bootstrap-icons.svg#file-earmark-person') }}"/></svg> Novo Usuário
                        </a>
                        <a href="{{ route('ar.trocaSenha') }}" class="list-group-item list-group-item-action">
                            <svg class="bi me-2" width="20" height="20">
                                <use xlink:href="{{ asset('site\bootstrap-icons.svg#lock') }}"/></svg> Alterar Senha
                        </a>
                        <a href="{{ route('login.destroy') }}" class="list-group-item list-group-item-action">
                            <svg class="bi me-2" width="20" height="20">
                                <use xlink:href="{{ asset('site\bootstrap-icons.svg#door-open') }}"/></svg> Sair
                        </a>
                    </div>
                </div>
                <div class="col-8">
                    
                    @yield('content')

                </div>
            </div>
        </div>
    </main>


    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src={{ asset('site/bootstrap.bundle.js') }}></script>
</body>

</html>