@extends('layouts.app')

@section('content')
<h2>Editar Mapa</h2>

<form action="{{ route('mapas.update', $mapa) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control" value="{{ $mapa->nome }}" required>
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea name="descricao" id="descricao" class="form-control">{{ $mapa->descricao }}</textarea>
    </div>

    <button class="btn btn-success">Atualizar</button>
</form>
@endsection
