@extends('layouts.app')

@section('content')
<h1>Criar Personagem</h1>

<form action="{{ route('personagens.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Descrição</label>
        <textarea name="descricao" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label>Imagem de Perfil (URL)</label>
        <input type="text" name="imagem_perfil" class="form-control">
    </div>
    <div class="mb-3">
        <label>Imagem Token (URL)</label>
        <input type="text" name="imagem_token" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Deslocamento</label>
        <input type="number" name="deslocamento" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
</form>
@endsection
