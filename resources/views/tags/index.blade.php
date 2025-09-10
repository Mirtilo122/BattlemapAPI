@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Tags</h1>
    <a href="{{ route('tags.create') }}" class="btn btn-primary">Nova Tag</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Cor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tags as $tag)
            <tr>
                <td>{{ $tag->nome }}</td>
                <td>{{ $tag->descricao }}</td>
                <td>
                    <span class="badge" style="background-color: {{ $tag->cor }};">{{ $tag->cor }}</span>
                </td>
                <td>
                    <a href="{{ route('tags.edit', $tag) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $tags->links() }}
@endsection
