@extends('layouts.arearestrita')

@section('nomeUser', auth()->user()->name )

@section('content')
    
    <link rel="stylesheet" href={{ asset('css/estilos.css') }}>

    <form class="col-8" method="post" enctype="multipart/form-data" action="{{ route('ar.salvaNovoBanner') }}">
        @csrf
        <h1>Cadastro de Banners</h1>

        <div class="input-group mb-3">
            <div class="input-group">
                <input type="file" name="imagen01" class="form-control d-none" multiple id="inputImagens1" accept="image/*">
                <label for="inputImagens1" class="image-button-banner">
                    <img id="previewImage1" src="#" alt="Preview" class="preview-image">
                    <span id="selectText1">Selecionar banner 1400 x 300 px</span>
                </label>
            </div>
            
            <div class="input-group">
                <input type="file" name="imagen02" class="form-control d-none" multiple id="inputImagens2" accept="image/*">
                <label for="inputImagens2" class="image-button-banner">
                    <img id="previewImage2" src="#" alt="Preview" class="preview-image">
                    <span id="selectText2">Selecionar banner 768 x 300 px</span>
                </label>
            </div>
            <button type="submit" style="width: 280px;" class="btn btn-lg btn-danger">Salvar</button>
        </div>
    </form>

    <hr class="mt-3">


    @if(count($banners) > 0)
        @foreach($banners as $banner)
            <ul class="list-group mb-3">
                <li class="list-group-item py-3">
                    <div class="row g-3">
                        <div class="col-8 ">
                            <a href="#">
                                <img src="{{ asset('storage/' . $banner->maior_resolucao) }}" class="img-thumbnail">
                            </a>
                            <a href="#">
                                <img src="{{ asset('storage/' . $banner->menor_resolucao) }}" class="img-thumbnail">
                            </a>
                        </div>
                        
                        <div class="col-4 align-self-center mt-3">
                            <div class="input-group">
                                <form action="{{ route('ar.apagaBanner', ['id' => $banner->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger border-dark btn-sm custon-tamanho-btn" type="submit">
                                        <svg class="bi me-2" width="20" height="20">
                                            <use xlink:href="{{ asset('site\bootstrap-icons.svg#trash') }}"/>
                                        </svg> Apagar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        @endforeach
    @else
        <h3>Nenhum banner encontrado :(</h3>
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