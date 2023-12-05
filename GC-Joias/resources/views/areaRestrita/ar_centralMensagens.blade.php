@extends('layouts.arearestrita')

@section('nomeUser', auth()->user()->name )

@section('content')
    
    <link rel="stylesheet" href={{ asset('css/estilos.css') }}>

    <h1>Central de Mensagens</h1>
    <hr class="mt-3">


    @if(count($mensagens) > 0)
        <div class="accordion" id="divPedidos">
            @foreach ($mensagens as $mensagem)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#mensagem{{ $mensagem->id }}">
                            <b>{{ $mensagem->nome }}</b>
                            <span class="mx-1">({{ $mensagem->email }}) -- {{ $mensagem->created_at }}</span>
                        </button>
                    </h2>
                    <div id="mensagem{{ $mensagem->id }}" class="accordion-collapse collapse" data-bs-parent="#divPedidos">
                        <div class="accordion-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Mensagem</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $mensagem->mensagem }}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-end" colspan="3">Ações</th>
                                        <td class="text-end">
                                            <form action="{{ route('ar.apagaCategoria', ['id' => $mensagem->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger border-dark btn-sm custon-tamanho-btn" type="submit">
                                                    <svg class="bi me-2" width="20" height="20">
                                                        <use xlink:href="{{ asset('site\bootstrap-icons.svg#trash') }}"/>
                                                    </svg> Apagar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
    @else
        <h3>Nenhum mensagem encontrada :(</h3>
    @endif

@endsection