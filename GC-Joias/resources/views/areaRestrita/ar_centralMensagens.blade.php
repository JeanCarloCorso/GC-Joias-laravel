@extends('layouts.arearestrita')

@section('nomeUser', auth()->user()->name )

@section('content')
    
    <link rel="stylesheet" href={{ asset('css/estilos.css') }}>

    <h1>Central de Mensagens</h1>
    <hr class="mt-3">

    <!--filtros-->
    <div>
        <label>Ordenar Mensagens: </label>
        <form class="d-inline-block" id="formOrdenacao" method="post" action="{{ route('ar.ordenarMensagens') }}">
            @csrf 
            <select class="form-select form-select-sm" name="ordenacao" onchange="submitForm()">
                <option disabled selected hidden>Ordenar</option>
                <option value="0">Todas</option>
                <option value="1">Lidas</option>
                <option value="2">Não Lidas</option>
            </select>
        </form>
    </div>

    @if(count($mensagens) > 0)
        <div class="accordion" id="divPedidos">
            @foreach ($mensagens as $mensagem)
                <div class="accordion-item @if(!$mensagem->respondida) msg-naoLida @endif">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed @if(!$mensagem->respondida) msg-naoLida @endif" type="button" data-bs-toggle="collapse"
                            data-bs-target="#mensagem{{ $mensagem->id }}">
                            <b>{{ $mensagem->nome }}</b>
                            <span class="mx-1">({{ $mensagem->email }}) -- {{ $mensagem->created_at }}</span>
                        </button>
                    </h2>
                    <div id="mensagem{{ $mensagem->id }}" class="accordion-collapse collapse" data-bs-parent="#divPedidos">
                        <div class="accordion-body">
                            <table class="table @if(!$mensagem->respondida) msg-naoLida @endif">
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
                                            <form action="{{ route('ar.marcarLidaNaoLida', ['id' => $mensagem->id]) }}" method="get">
                                                @csrf
                                                <button class="btn btn-outline-danger border-dark btn-sm custon-tamanho-btn" type="submit">
                                                    <svg class="bi me-2" width="20" height="20">
                                                        @if($mensagem->respondida)
                                                            <use xlink:href="{{ asset('site\bootstrap-icons.svg#envelope') }}"/>
                                                        @else
                                                            <use xlink:href="{{ asset('site\bootstrap-icons.svg#envelope-open') }}"/>
                                                        @endif
                                                    </svg> 
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

<script>
    function submitForm() {
        document.getElementById("formOrdenacao").submit();
    }
</script>