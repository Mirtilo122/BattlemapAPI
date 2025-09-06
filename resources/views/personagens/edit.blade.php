@extends('layouts.app')

@section('content')
<h1>Editar Personagem</h1>

<form action="{{ route('personagens.update', $personagem) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" value="{{ $personagem->nome }}" required>
    </div>
    <div class="mb-3">
        <label>Descrição</label>
        <textarea name="descricao" class="form-control">{{ $personagem->descricao }}</textarea>
    </div>
    <div class="mb-3">
        <label>Imagem de Perfil (URL)</label>
        <input type="text" name="imagem_perfil" class="form-control" value="{{ $personagem->imagem_perfil }}">
    </div>
    <div class="mb-3">
        <label>Imagem Token (URL)</label>
        <input type="text" name="imagem_token" class="form-control" value="{{ $personagem->imagem_token }}" required>
    </div>
    <div class="mb-3">
        <label>Deslocamento</label>
        <input type="number" name="deslocamento" class="form-control" value="{{ $personagem->deslocamento }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>
@endsection
