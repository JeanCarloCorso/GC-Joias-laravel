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

document.addEventListener("DOMContentLoaded", function () {
    const inputFiltroNomeSmall = document.getElementById('filtroNomeSmall');
    const inputFiltroNomeLarge = document.getElementById('filtroNomeLarge');
    const checkboxes = document.querySelectorAll('.categoria-checkbox');
    const produtos = document.querySelectorAll('.produto');
    const selectElement = document.querySelector('select[name="ordenacao"]');
    const container = document.getElementById('containerProdutos');

    const handleInput = function (input) {
        const filtroNome = input.value.toLowerCase().trim();
        const minPrice = parseFloat(document.getElementById('minPrice').textContent);
        const maxPrice = parseFloat(document.getElementById('maxPrice').textContent);
        const categorias = categoriasSelecionadas();

        produtos.forEach(produto => {
            const nomeProduto = produto.getAttribute('data-nome').toLowerCase();
            const categoriaProduto = produto.getAttribute('data-categoria');
            const precoProduto = parseFloat(produto.getAttribute('data-preco'));

            const nomeFiltroPassou = nomeProduto.includes(filtroNome);
            const categoriaFiltroPassou = categorias.length === 0 || categorias.includes(categoriaProduto);
            const precoFiltroPassou = precoProduto >= minPrice && precoProduto <= maxPrice;

            if (nomeFiltroPassou && categoriaFiltroPassou && precoFiltroPassou) {
                produto.style.display = 'block';
            } else {
                produto.style.display = 'none';
            }
        });
    };

    const categoriasSelecionadas = () => {
        const categorias = [];
        checkboxes.forEach(cb => {
            if (cb.checked) {
                categorias.push(cb.getAttribute('id'));
            }
        });
        return categorias;
    };

    const inputChangeHandler = function () {
        handleInput(this);
    };

    inputFiltroNomeSmall.addEventListener('input', inputChangeHandler);
    inputFiltroNomeLarge.addEventListener('input', inputChangeHandler);

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            handleInput(inputFiltroNomeSmall);
            handleInput(inputFiltroNomeLarge);
        });
    });

    const createPriceSlider = function (sliderId, minPriceInputId, maxPriceInputId) {
        const minPriceInput = document.getElementById(minPriceInputId);
        const maxPriceInput = document.getElementById(maxPriceInputId);
        const priceSlider = document.getElementById(sliderId);

        noUiSlider.create(priceSlider, {
            start: [0, 500],
            connect: true,
            range: {
                'min': 0,
                'max': 500
            }
        });

        const handlePriceFilter = function (values) {
            minPriceInput.textContent = Math.round(values[0]);
            maxPriceInput.textContent = Math.round(values[1]);
            handleInput(inputFiltroNomeSmall);
            handleInput(inputFiltroNomeLarge);
        };

        priceSlider.noUiSlider.on('update', function (values) {
            handlePriceFilter(values);
        });
    };

    createPriceSlider('priceSlider', 'minPrice', 'maxPrice');
    createPriceSlider('priceSliderSmall', 'minPriceSmall', 'maxPriceSmall');

    const updateProductsOrder = function () {
        const selectedValue = parseInt(selectElement.value);
        const produtosArray = Array.from(container.querySelectorAll('.produto'));

        switch (selectedValue) {
            case 0:
                produtosArray.sort((a, b) => {
                    return a.dataset.nome.localeCompare(b.dataset.nome);
                });
                break;
            case 1:
                produtosArray.sort((a, b) => {
                    return parseFloat(a.dataset.preco) - parseFloat(b.dataset.preco);
                });
                break;
            case 2:
                produtosArray.sort((a, b) => {
                    return parseFloat(b.dataset.preco) - parseFloat(a.dataset.preco);
                });
                break;
            case 3:
                produtosArray.sort((a, b) => {
                    return new Date(b.dataset.data.replace(' ', 'T')) - new Date(a.dataset.data.replace(' ', 'T'));
                });
                break;
            case 4:
                produtosArray.sort((a, b) => {
                    return new Date(a.dataset.data.replace(' ', 'T')) - new Date(b.dataset.data.replace(' ', 'T'));
                });
                break;
            default:
                break;
        }

        // Reorganiza os cards de produtos no DOM
        container.innerHTML = '';
        produtosArray.forEach(function (produto) {
            container.appendChild(produto);
        });
    };

    selectElement.addEventListener('change', updateProductsOrder);
});