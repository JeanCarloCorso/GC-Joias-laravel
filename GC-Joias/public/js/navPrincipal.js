document.addEventListener("DOMContentLoaded", function () {
    var navbarToggler = document.querySelector('.menuHamburger');
    var navMobileDiv = document.getElementById('navMobile');

    navbarToggler.addEventListener('click', function () {
        navMobileDiv.classList.toggle('visible'); // Adiciona ou remove a classe 'visible'
    });
});

function closeNav() {
    var navMobile = document.getElementById('navMobile');
    navMobile.classList.remove('visible'); // Remove a classe 'visible' ao fechar a navegação
}
