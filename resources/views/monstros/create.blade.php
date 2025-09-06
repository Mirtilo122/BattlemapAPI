@extends('layouts.app')

@section('content')
<h1>Criar Monstro</h1>

<form action="{{ route('monstros.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Deslocamento Base</label>
        <input type="number" name="deslocamento_base" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Imagem de Perfil (URL)</label>
        <input type="text" name="imagem_perfil" class="form-control">
    </div>
    <div class="mb-3">
        <label>Imagem Token (URL)</label>
        <input type="text" name="imagem_token" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
</form>
@endsection
