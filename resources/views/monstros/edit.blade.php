@extends('layouts.app')

@section('content')
<h1>Editar Monstro</h1>

<form action="{{ route('monstros.update', $monstro) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" value="{{ $monstro->nome }}" required>
    </div>
    <div class="mb-3">
        <label>Deslocamento Base</label>
        <input type="number" name="deslocamento_base" class="form-control" value="{{ $monstro->deslocamento_base }}" required>
    </div>
    <div class="mb-3">
        <label>Imagem de Perfil (URL)</label>
        <input type="text" name="imagem_perfil" class="form-control" value="{{ $monstro->imagem_perfil }}">
    </div>
    <div class="mb-3">
        <label>Imagem Token (URL)</label>
        <input type="text" name="imagem_token" class="form-control" value="{{ $monstro->imagem_token }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>
@endsection
