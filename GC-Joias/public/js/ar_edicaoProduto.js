$(document).ready(function() {
    // Se a imagem existe, defina o valor do input
    if ($produto.imagens[0]) {
    $("#inputImagens1").val(asset('storage/' . $produto.imagens[0].path));
    }
});

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