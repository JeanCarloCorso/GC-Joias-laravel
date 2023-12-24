# Página de Vendas de Semijoias

Este projeto é uma plataforma de comércio eletrônico desenvolvida em Laravel 9.52.16, focada na apresentação de semijoias e integrada com o WhatsApp para facilitar as vendas.

## Visão Geral

O objetivo principal deste projeto é oferecer uma interface elegante e intuitiva para a apresentação e venda de semijoias. A integração com o WhatsApp permite aos usuários interessados entrar em contato diretamente com os vendedores para concluir suas compras.

## Funcionalidades Principais

- **Apresentação de Produtos:** Exibição de catálogo de semijoias com detalhes e imagens atrativas.
- **Integração com WhatsApp:** Facilita a comunicação entre o vendedor e clientes para fechar vendas.
- **Páginas Responsivas:** Design responsivo para garantir uma experiência consistente em diferentes dispositivos.

## Tecnologias Utilizadas

- **Laravel 9.52.16:** Framework PHP utilizado para o desenvolvimento do backend.
- **HTML, CSS, JavaScript:** Tecnologias web para a criação da interface e interações do usuário.
- **WhatsApp API:** Integração utilizando a API do WhatsApp para comunicação direta.

## Instalação e Uso

1. Clonar Repositório

~~~bach
git clone https://github.com/JeanCarloCorso/GC-Joias-laravel.git
~~~~

2. Configuração do Ambiente:

- Configurar as variáveis de ambiente no arquivo .env com as credenciais necessárias.
- Configurar as variaveis em GC-Joias/config/app.php

4. Rode a Migration

~~~bach
php artisan migrate
~~~~

5. Executar o Projeto:

~~~bach
php artisan serve
~~~~

6. Acessar a aplicação em http://localhost:8000 no navegador.
7. Para cadastrar os produtos e dentre outras funcionalidades acesse http://localhost:8000/login

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou pull requests para melhorias, correções de bugs, ou novas funcionalidades.
