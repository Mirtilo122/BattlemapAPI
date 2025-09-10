@extends('layouts.app')

@section('content')
<h1>Editar Tipo de Item</h1>

<form action="{{ route('tipos.update', $tipo) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" value="{{ $tipo->nome }}" required>
    </div>
    <div class="mb-3">
        <label>Descrição</label>
        <textarea name="descricao" class="form-control">{{ $tipo->descricao }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>
@endsection
