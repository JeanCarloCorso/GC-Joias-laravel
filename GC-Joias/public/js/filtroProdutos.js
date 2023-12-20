document.addEventListener("DOMContentLoaded", function () {
    var botao = document.querySelector('.btnFiltro');
    var filtroMobileDiv = document.getElementById('filtroMobile');

    botao.addEventListener('click', function () {
        filtroMobileDiv.classList.toggle('visible');
    });
});

function closeFiltro() {
    var filtroMobile = document.getElementById('filtroMobile');
    filtroMobile.classList.remove('visible'); 
}


document.addEventListener("DOMContentLoaded", function() {
    const inputFiltroNomeSmall = document.getElementById('filtroNomeSmall');
    const inputFiltroNomeLarge = document.getElementById('filtroNomeLarge');
    const produtos = document.querySelectorAll('.produto');

    const handleInput = function(input) {
        const filtroNome = input.value.toLowerCase().trim();

        produtos.forEach(produto => {
            const nomeProduto = produto.getAttribute('data-nome').toLowerCase();

            if (nomeProduto.includes(filtroNome)) {
                produto.style.display = 'block';
            } else {
                produto.style.display = 'none';
            }
        });
    };

    inputFiltroNomeSmall.addEventListener('input', function() {
        handleInput(inputFiltroNomeSmall);
    });

    inputFiltroNomeLarge.addEventListener('input', function() {
        handleInput(inputFiltroNomeLarge);
    });
});




document.addEventListener('DOMContentLoaded', function () {
    // Selecione todos os checkboxes de categoria
    const checkboxes = document.querySelectorAll('.categoria-checkbox');

    // Adicione um ouvinte de evento para cada checkbox
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            // Array para armazenar as categorias selecionadas
            const categoriasSelecionadas = [];

            // Iterar por todas as checkboxes para verificar quais estão marcadas
            checkboxes.forEach(function (cb) {
                if (cb.checked) {
                    categoriasSelecionadas.push(cb.getAttribute('id'));
                }
            });

            // Selecionar todos os produtos
            const produtos = document.querySelectorAll('.produto');

            // Iterar por todos os produtos para mostrar/esconder com base nas categorias selecionadas
            produtos.forEach(function (produto) {
                const categoriaProduto = produto.getAttribute('data-categoria');

                // Verificar se a categoria do produto está nas categorias selecionadas
                if (categoriasSelecionadas.length === 0 || categoriasSelecionadas.includes(categoriaProduto)) {
                    produto.style.display = 'block'; // Exibir o produto
                } else {
                    produto.style.display = 'none'; // Ocultar o produto
                }
            });
        });
    });
});


