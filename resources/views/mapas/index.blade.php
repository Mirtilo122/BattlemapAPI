@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Mapas</h2>

    @if(session('user') && session('user')->acesso === 'dm')
        <a href="{{ route('mapas.create') }}" class="btn btn-primary">Criar Mapa</a>
    @endif
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mapas as $mapa)
            <tr>
                <td>{{ $mapa->nome }}</td>
                <td>{{ $mapa->descricao }}</td>
                <td>
                    <a href="{{ route('mapas.show', $mapa) }}" class="btn btn-sm btn-info">Acessar</a>
                    @if(session('user') && session('user')->acesso === 'dm')
                        <a href="{{ route('mapas.edit', $mapa) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('mapas.destroy', $mapa) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Excluir</button>
                        </form>

                        <a href="{{ route('quartos.index', $mapa) }}" class="btn btn-sm btn-primary">
                            Quartos
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
