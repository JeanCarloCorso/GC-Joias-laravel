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
                <div class="align-self-end">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white">Bem-vindo,&nbsp;@yield('nomeUser', 'Usuário')</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-fill">
        <div class="container">
            <h3>Área Restrita</h3>
            <div class="row gx-3">
                <div class="col-4">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action bg-danger text-light">
                            <svg class="bi me-2" width="20" height="20" fill="white">
                                <use xlink:href="{{ asset('site\bootstrap-icons.svg#folder') }}"/></svg> Listar Produtos
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <svg class="bi me-2" width="20" height="20">
                                <use xlink:href="{{ asset('site\bootstrap-icons.svg#plus-circle') }}"/></svg> Cadastrar Produto
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <svg class="bi me-2" width="20" height="20">
                                <use xlink:href="{{ asset('site\bootstrap-icons.svg#play') }}"/></svg> Banner
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <svg class="bi me-2" width="20" height="20">
                                <use xlink:href="{{ asset('site\bootstrap-icons.svg#mailbox') }}"/></svg> Mensagens
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <svg class="bi me-2" width="20" height="20">
                                <use xlink:href="{{ asset('site\bootstrap-icons.svg#person') }}"/></svg> Dados Pessoais
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
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