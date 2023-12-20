document.addEventListener("DOMContentLoaded", function () {
    var botao = document.querySelector('.btnFiltro');
    var filtroMobileDiv = document.getElementById('filtroMobile');

    botao.addEventListener('click', function () {
        filtroMobileDiv.classList.toggle('visible');
    });
});

function closeFiltro() {
    var filtroMobile = document.getElementById('filtroMobile');
    filtroMobile.classList.remove('visible'); // Remove a classe 'visible' ao fechar a navegação
}
