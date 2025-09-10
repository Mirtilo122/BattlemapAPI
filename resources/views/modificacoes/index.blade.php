@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>{{ ucfirst($tipo) }}</h1>

    @if(auth()->check() && auth()->user()->acesso === 'dm')
        <a href="{{ route($tipo . '.create') }}" class="btn btn-primary">Nova {{ ucfirst($tipo) }}</a>
    @endif
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Tipos aplicáveis</th>
            <th>Tags</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($modificacoes as $modificacao)
            <tr>
                <td>
                    <a href="{{ route($tipo . '.show', $modificacao) }}">{{ $modificacao->nome }}</a>
                </td>
                <td>{{ $modificacao->tipo }}</td>
                <td>{{ implode(', ', $modificacao->tipos ?? []) }}</td>
                <td>
                    @foreach($modificacao->tags as $tag)
                        <span class="badge" style="background-color: {{ $tag->cor }}">{{ $tag->nome }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route($tipo . '.show', $modificacao) }}" class="btn btn-info btn-sm">Ver</a>
                    @if(auth()->check() && auth()->user()->acesso === 'dm')
                        <a href="{{ route($tipo . '.edit', $modificacao) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route($tipo . '.destroy', $modificacao) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $modificacoes->links() }}
@endsection
