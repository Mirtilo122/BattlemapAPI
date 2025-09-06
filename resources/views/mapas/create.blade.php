@extends('layouts.app')

@section('content')
<h2>Criar Mapa</h2>

<form action="{{ route('mapas.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea name="descricao" id="descricao" class="form-control"></textarea>
    </div>

    <button class="btn btn-success">Salvar</button>
</form>
@endsection
