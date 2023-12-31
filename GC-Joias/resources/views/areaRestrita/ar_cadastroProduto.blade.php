@extends('layouts.arearestrita')

@section('nomeUser', auth()->user()->name )

@section('content')
    
    <link rel="stylesheet" href={{ asset('css/estilos.css') }}>

    <form class="col-8" method="post" enctype="multipart/form-data" action="{{ route('ar.salvaNovoProduto') }}">
        @csrf
        <h1>Cadastro de Produto</h1>

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
            <input type="text" id="txtNome" class="form-control" name="nome" placeholder=" ">
            <label for="txtNome">Nome do Produto</label>
        </div>

        <div class="input-group mb-3">
            <div class="d-flex justify-content-between">
                <div class="form-floating mb-3">
                    <select class="form-select" id="categoria" name="genero">
                        <option value="" selected disabled>Selecione o genero</option>
                        @foreach($generos as $genero)
                            <option value="{{ $genero->id }}">{{ $genero->descricao }}</option>
                        @endforeach
                    </select>
                    <label for="categoria">Genero</label>
                </div>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" id="categoria" name="categoria">
                    <option value="" selected disabled>Selecione a categoria</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $genero->id }}">{{ $categoria->descricao }}</option>
                    @endforeach
                </select>
                <label for="categoria">Categoria</label>
            </div>
        </div>

        <div class="form-floating mb-3">
            <input type="number" id="txtQuantidade" class="form-control" name="quantidade" placeholder=" ">
            <label for="txtQuantidade">Quantidade</label>
        </div>

        <div class="input-group mb-3">
            <div class="d-flex justify-content-between">
                <div class="form-floating mb-3">
                    <input type="text" id="formattedCusto" class="form-control" name="custo" placeholder="0.00">
                    <label for="formattedCusto">Custo</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" id="formattedPreco" class="form-control" name="preco" placeholder="0.00">
                    <label for="formattedPreco">Preço</label>
                </div>
            </div>
        </div>

        <div class="form-floating mb-3">
            <textarea id="txtDescricaoCurta" class="form-control" name="descricaoCurta"></textarea>
            <label for="txtDescricaoCurta">Descrição Curta</label>
        </div>

        <label>Descrição Detalhada</label>
        <div class="form-floating mb-3">
            <textarea id="txtDescricao" class="form-control" name="descricaoDetalhada"></textarea>
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