@extends('layouts.arearestrita')

@section('nomeUser', auth()->user()->name )

@section('content')
    
    <link rel="stylesheet" href={{ asset('css/estilos.css') }}>

    <form class="col-8" method="post" enctype="multipart/form-data" action="{{ route('ar.salvarEdicaoProduto') }}">
        @csrf
        <h1>Editar o Produto</h1>

        <input type="hidden" name="id" value="{{ $produto->id }}">
        <div class="input-group mb-3">
            <div class="d-flex justify-content-between">
                <div class="input-group">
                    <input type="file" name="imagen01" class="form-control d-none" multiple id="inputImagens1" accept="image/*">
                    <label for="inputImagens1" class="image-button">
                        <img id="previewImage1" src="#" alt="Preview" class="preview-image">
                        <span id="selectText1">Selecionar Imagem 01</span>
                    </label>
                </div>
                
                <div class="input-group">
                    <input type="file" name="imagen02" class="form-control d-none" multiple id="inputImagens2" accept="image/*">
                    <label for="inputImagens2" class="image-button">
                        <img id="previewImage2" src="#" alt="Preview" class="preview-image">
                        <span id="selectText2">Selecionar Imagem 02</span>
                    </label>
                </div>
                
                <div class="input-group">
                    <input type="file" name="imagen03" class="form-control d-none" multiple id="inputImagens3" accept="image/*">
                    <label for="inputImagens3" class="image-button">
                        <img id="previewImage3" src="#" alt="Preview" class="preview-image">
                        <span id="selectText3">Selecionar Imagem 03</span>
                    </label>
                </div>
                
                <div class="input-group">
                    <input type="file" name="imagen04" class="form-control d-none" multiple id="inputImagens4" accept="image/*">
                    <label for="inputImagens4" class="image-button">
                        <img id="previewImage4" src="#" alt="Preview" class="preview-image">
                        <span id="selectText4">Selecionar Imagem 04</span>
                    </label>
                </div>
            </div>
        </div>
        
        <div class="form-floating mb-3">
            <input type="text" id="txtNome" class="form-control" name="nome" value="{{ $produto->nome }}" placeholder=" ">
            <label for="txtNome">Nome do Produto</label>
        </div>

        <div class="input-group mb-3">
            <div class="d-flex justify-content-between">
                <div class="form-floating mb-3">
                    <select class="form-select" id="categoria" name="genero">
                        <option value="" selected disabled>Selecione o genero</option>
                        @foreach($generos as $genero)
                        <option value="{{ $genero->id }}" {{ $produto->genero_id == $genero->id ? 'selected' : '' }}>
                            {{ $genero->descricao }}
                        </option>
                        @endforeach
                    </select>
                    <label for="categoria">Genero</label>
                </div>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" id="categoria" name="categoria">
                    <option value="" selected disabled>Selecione a categoria</option>
                    @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $produto->categoria_id == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->descricao }}
                    </option>
                    @endforeach
                </select>
                <label for="categoria">Categoria</label>
            </div>
        </div>

        <div class="form-floating mb-3">
            <input type="number" id="txtQuantidade" class="form-control" value="{{ $produto->quantidade }}" name="quantidade" placeholder=" ">
            <label for="txtQuantidade">Quantidade</label>
        </div>

        <div class="input-group mb-3">
            <div class="d-flex justify-content-between">
                <div class="form-floating mb-3">
                    <input type="text" id="formattedCusto" class="form-control" value="{{ $produto->custo }}" name="custo" placeholder="0.00">
                    <label for="formattedCusto">Custo</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" id="formattedPreco" class="form-control" value="{{ $produto->preco }}" name="preco" placeholder="0.00">
                    <label for="formattedPreco">Preço</label>
                </div>
            </div>
        </div>

        <div class="form-floating mb-3">
            <textarea id="txtDescricaoCurta" class="form-control" name="descricaoCurta">{{ $produto->descricao_curta }}</textarea>
            <label for="txtDescricaoCurta">Descrição Curta</label>
        </div>

        <label>Descrição Detalhada</label>
        <div class="form-floating mb-3">
            <textarea id="txtDescricao" class="form-control" name="descricaoDetalhada">{{ $produto->descricao_detalhada }}</textarea>
        </div>

        <button type="submit" class="btn btn-lg btn-danger">Salvar</button>
    </form>

    <div class="notification-container top-right">
        @if ($errors->has('nome'))
            <div class="error-notification larger">{{ $errors->first('nome') }}</div>
        @endif
        @if ($errors->has('quantidade'))
            <div class="error-notification larger">{{ $errors->first('quantidade') }}</div>
        @endif
        @if ($errors->has('preco'))
            <div class="error-notification larger">{{ $errors->first('preco') }}</div>
        @endif
        @if ($errors->has('descricao'))
            <div class="error-notification larger">{{ $errors->first('descricao') }}</div>
        @endif
        @if ($errors->has('genero'))
            <div class="error-notification larger">{{ $errors->first('genero') }}</div>
        @endif
        @if ($errors->has('categoria'))
            <div class="error-notification larger">{{ $errors->first('categoria') }}</div>
        @endif
        @if ($errors->has('imagen01'))
            <div class="error-notification larger">{{ $errors->first('imagen01') }}</div>
        @endif
        @if ($errors->has('imagen02'))
            <div class="error-notification larger">{{ $errors->first('imagen02') }}</div>
        @endif
        @if ($errors->has('imagen03'))
            <div class="error-notification larger">{{ $errors->first('imagen03') }}</div>
        @endif
        @if ($errors->has('imagen04'))
            <div class="error-notification larger">{{ $errors->first('imagen04') }}</div>
        @endif
    </div>


    <script>
        $(document).ready(function() {
            // Se a imagem existe, defina o valor do input
            if ($produto.imagens[0]) {
            $("#inputImagens1").val(asset('storage/' . $produto.imagens[0].path));
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const previewImage1 = document.querySelector('#previewImage1');
            const selectText1 = document.querySelector('#selectText1');

            const previewImage2 = document.querySelector('#previewImage2');
            const selectText2 = document.querySelector('#selectText2');

            const previewImage3 = document.querySelector('#previewImage3');
            const selectText3 = document.querySelector('#selectText3');

            const previewImage4 = document.querySelector('#previewImage4');
            const selectText4 = document.querySelector('#selectText4');


            @if ($produto->imagens->count() >= 1)
                previewImage1.src = "{{ asset('storage/' . $produto->imagens[0]->path) }}";
                previewImage1.style.display = 'block';
                selectText1.style.display = 'none';
            @endif

            @if ($produto->imagens->count() >= 2)
                previewImage2.src = "{{ asset('storage/' . $produto->imagens[1]->path) }}";
                previewImage2.style.display = 'block';
                selectText2.style.display = 'none';
            @endif

            @if ($produto->imagens->count() >= 3)
                previewImage3.src = "{{ asset('storage/' . $produto->imagens[2]->path) }}";
                previewImage3.style.display = 'block';
                selectText3.style.display = 'none';
            @endif

            @if ($produto->imagens->count() >= 4)
                previewImage4.src = "{{ asset('storage/' . $produto->imagens[3]->path) }}";
                previewImage4.style.display = 'block';
                selectText4.style.display = 'none';
            @endif
        });
    </script>

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

    <!-- CDN do TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/gs1dg5d7ux271islobb09s7q01jj4oh5b939g1xanust44fq/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        // Inicialize o TinyMCE
        tinymce.init({
            selector: 'textarea#txtDescricao', // Seletor para o campo de descrição
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            height: 300, // Altura do editor
            menubar: false, // Oculta a barra de menu
            toolbar: 'undo redo | formatselect | ' +
                'bold italic underline strikethrough | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'outdent indent | numlist bullist | ' +
                'link image | removeformat | code'
        });
    </script>

    <script>
        function formatCurrency(inputId) {
            const inputField = document.getElementById(inputId);
            inputField.addEventListener('input', function (e) {
                let inputValue = e.target.value.replace(/\D/g, ''); // Remove todos os caracteres que não sejam dígitos

                // Se a entrada começar com zero, remova esse zero para evitar problemas de formatação
                if (inputValue.length > 1 && inputValue[0] === '0') {
                    inputValue = inputValue.slice(1);
                }

                // Adiciona zeros à esquerda até que a entrada tenha pelo menos 3 caracteres
                while (inputValue.length < 3) {
                    inputValue = '0' + inputValue;
                }

                // Insere uma vírgula antes dos dois últimos dígitos
                let formattedValue = inputValue.slice(0, -2) + '.' + inputValue.slice(-2);

                e.target.value = formattedValue;
            });
        }

        formatCurrency('formattedCusto'); // Chama a função para o campo Custo
        formatCurrency('formattedPreco'); // Chama a função para o campo Preço
    </script>


@endsection