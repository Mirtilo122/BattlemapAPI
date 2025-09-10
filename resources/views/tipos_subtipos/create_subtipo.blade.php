@extends('layouts.app')

@section('content')
<h1>Criar Subtipo de Item</h1>

<form action="{{ route('subtipos.store') }}" method="POST">
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
        <label>Tipo Pai</label>
        <select name="tipo_item_id" class="form-control" required>
            <option value="">Selecione o tipo</option>
            @foreach($tipos as $tipo)
                <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
</form>
@endsection
