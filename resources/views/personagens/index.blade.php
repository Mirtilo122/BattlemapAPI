@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Personagens</h1>
    <a href="{{ route('personagens.create') }}" class="btn btn-primary">Novo Personagem</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Token</th>
            <th>Dono</th>
            <th>Ações</th>
        </tr> 
    </thead>
    <tbody>
        @foreach($personagens as $personagem)
            <tr>
                <td>{{ $personagem->nome }}</td>
                <td><img src="{{ $personagem->imagem_token }}" alt="token" width="50"></td>
                <td>{{ $personagem->owner->name }}</td>
                <td>
                    <a href="{{ route('personagens.show', $personagem) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('personagens.edit', $personagem) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('personagens.destroy', $personagem) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $personagens->links() }}
@endsection
