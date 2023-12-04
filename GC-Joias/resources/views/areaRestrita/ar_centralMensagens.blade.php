@extends('layouts.arearestrita')

@section('nomeUser', auth()->user()->name )

@section('content')
    
    <link rel="stylesheet" href={{ asset('css/estilos.css') }}>

    <form class="col-8" method="post" enctype="multipart/form-data" action="{{ route('ar.salvaNovaCategoria') }}">
        @csrf
        <h1>Cadastro de Categorias</h1>

        <div class="form-floating mb-3">
            <input type="text" id="txtNome" class="form-control" name="categoria" placeholder=" " autofocus>
            <label for="txtNome">Nova Categoria</label>
        </div>
        
        <button type="submit" class="btn btn-lg btn-danger">Salvar Nova Categoria</button>
        
    </form>

    <hr class="mt-3">


    @if(count($mensagens) > 0)
        <ul class="list-group mb-3">
            <li class="list-group-item py-3">
                <div class="row g-3">
                    
                    

                    <table class="table">
                        <thead>
                            <tr>
                            <th>Categoria</th>
                            <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mensagens as $mensagem)
                            <tr>
                                <td>{{ $mensagem->nome }}</td>
                                <td>
                                    <form action="{{ route('ar.apagaCategoria', ['id' => $mensagem->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger border-dark btn-sm custon-tamanho-btn" type="submit">
                                            <svg class="bi me-2" width="20" height="20">
                                                <use xlink:href="{{ asset('site\bootstrap-icons.svg#trash') }}"/>
                                            </svg> Apagar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </li>
        </ul>
    @else
        <h3>Nenhum mensagem encontrada :(</h3>
    @endif

    <div class="notification-container top-right">
        
        @if ($errors->has('imagen01'))
            <div class="error-notification larger">{{ $errors->first('imagen01') }}</div>
        @endif
        @if ($errors->has('imagen02'))
            <div class="error-notification larger">{{ $errors->first('imagen02') }}</div>
        @endif
        @if (session('bannerAdd'))
            <div class="success-notification larger">{{ session('bannerAdd') }}</div>
        @endif
        @if (session('bannerRemove'))
            <div class="success-notification larger">{{ session('bannerRemove') }}</div>
        @endif
    </div>

    <script>
        document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function() {
            const reader = new FileReader();
            const previewImage = this.parentElement.querySelector('.preview-image');
            const selectText = this.parentElement.querySelector('span');

            reader.onload = function() {
                previewImage.src = reader.result;
                previewImage.style.display = 'block';
                selectText.style.display = 'none';
            }

            if (this.files[0]) {
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
    </script>

@endsection