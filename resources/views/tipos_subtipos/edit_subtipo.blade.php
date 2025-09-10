@extends('layouts.app')

@section('content')
<h1>Editar Subtipo de Item</h1>

<form action="{{ route('subtipos.update', $subtipo) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" value="{{ $subtipo->nome }}" required>
    </div>
    <div class="mb-3">
        <label>Descrição</label>
        <textarea name="descricao" class="form-control">{{ $subtipo->descricao }}</textarea>
    </div>
    <div class="mb-3">
        <label>Tipo Pai</label>
        <select name="tipo_item_id" class="form-control" required>
            @foreach($tipos as $tipo)
                <option value="{{ $tipo->id }}" {{ $tipo->id == $subtipo->tipo_item_id ? 'selected' : '' }}>{{ $tipo->nome }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>
@endsection
