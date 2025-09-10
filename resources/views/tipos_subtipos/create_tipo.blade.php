@extends('layouts.app')

@section('content')
<h1>Criar Tipo de Item</h1>

<form action="{{ route('tipos.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Descrição</label>
        <textarea name="descricao" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
</form>
@endsection
