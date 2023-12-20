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
    const checkboxes = document.querySelectorAll('.categoria-checkbox');

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const categoriasSelecionadas = [];

            checkboxes.forEach(function (cb) {
                if (cb.checked) {
                    categoriasSelecionadas.push(cb.getAttribute('id'));
                }
            });

            // Selecionar todos os produtos
            const produtos = document.querySelectorAll('.produto');

            produtos.forEach(function (produto) {
                const categoriaProduto = produto.getAttribute('data-categoria');

                if (categoriasSelecionadas.length === 0 || categoriasSelecionadas.includes(categoriaProduto)) {
                    produto.style.display = 'block'; 
                } else {
                    produto.style.display = 'none'; 
                }
            });
        });
    });
});


document.addEventListener("DOMContentLoaded", function() {
    const minPriceInput = document.getElementById('minPrice');
    const maxPriceInput = document.getElementById('maxPrice');
    const produtos = document.querySelectorAll('.produto');

    const priceSlider = document.getElementById('priceSlider');

    noUiSlider.create(priceSlider, {
        start: [0, 500],
        connect: true,
        range: {
            'min': 0,
            'max': 500
        }
    });

    // Função para filtrar produtos com base no preço
    const handlePriceFilter = function(values) {
        const minPrice = parseFloat(values[0]);
        const maxPrice = parseFloat(values[1]);

        produtos.forEach(produto => {
            const precoProduto = parseFloat(produto.getAttribute('data-preco'));

            if (precoProduto >= minPrice && precoProduto <= maxPrice) {
                produto.style.display = 'block';
            } else {
                produto.style.display = 'none';
            }
        });
    };

    // Atualize os valores mínimo e máximo conforme o controle deslizante é movido
    priceSlider.noUiSlider.on('update', function(values) {
        minPriceInput.textContent = Math.round(values[0]);
        maxPriceInput.textContent = Math.round(values[1]);
        handlePriceFilter(values);
    });
});
