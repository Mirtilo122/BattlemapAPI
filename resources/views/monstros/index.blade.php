@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Monstros</h1>
    <a href="{{ route('monstros.create') }}" class="btn btn-primary">Novo Monstro</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Token</th>
            <th>Deslocamento</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($monstros as $monstro)
            <tr>
                <td>{{ $monstro->nome }}</td>
                <td><img src="{{ $monstro->imagem_token }}" alt="token" width="50"></td>
                <td>{{ $monstro->deslocamento_base }}</td>
                <td>
                    <a href="{{ route('monstros.show', $monstro) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('monstros.edit', $monstro) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('monstros.destroy', $monstro) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $monstros->links() }}
@endsection
