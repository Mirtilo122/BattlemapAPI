@extends('layouts.app')

@section('content')
<h1>Criar {{ ucfirst($tipo) }}</h1>

<form action="{{ route($tipo.'.store') }}" method="POST">
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
        <label>Habilidade</label>
        <textarea name="habilidade" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label for="tipos">Tipos aplicáveis</label>
        <select id="tipos" name="tipos[]" class="form-control selectpicker" multiple data-live-search="true" title="Selecione os tipos">
            @foreach($tiposItens as $tipo)
                <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="tags">Tags</label>
        <select id="tags" name="tags[]" class="form-control selectpicker" multiple data-live-search="true" title="Selecione as tags">
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->nome }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
</form>
@endsection
