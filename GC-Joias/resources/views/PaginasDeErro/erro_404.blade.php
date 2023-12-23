@extends('layouts.default')

@section('title', ':: ERRO')

@section('pgerros')
<link rel="stylesheet" href={{ asset('css/erros.css') }}>

  <div class="error-container">
    <div class="error-content">
      <h1>Erro 404</h1>
      <p>Desculpe, a página que você está procurando não pôde ser encontrada.</p>
    </div>
  </div>

@endsection