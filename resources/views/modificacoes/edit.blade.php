@extends('layouts.app')

@section('content')
<h1>Editar {{ ucfirst($tipo) }}</h1>

<form action="{{ route($tipo.'.update', $modificacao) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" value="{{ $modificacao->nome }}" required>
    </div>
    <div class="mb-3">
        <label>Descrição</label>
        <textarea name="descricao" class="form-control">{{ $modificacao->descricao }}</textarea>
    </div>
    <div class="mb-3">
        <label>Habilidade</label>
        <textarea name="habilidade" class="form-control">{{ $modificacao->habilidade }}</textarea>
    </div>
    <div class="mb-3">
        <label>Tipo</label>
        <select name="tipo" class="form-control" required>
            <option value="Melhoria" @if($modificacao->tipo == 'Melhoria') selected @endif>Melhoria</option>
            <option value="Maldicao" @if($modificacao->tipo == 'Maldicao') selected @endif>Maldição</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="tipos">Tipos aplicáveis</label>
        <select id="tipos" name="tipos[]" class="form-control selectpicker" multiple data-live-search="true" title="Selecione os tipos">
            @foreach($tiposItens as $tipo)
                <option value="{{ $tipo->id }}"
                    @if(!empty($modificacao->tipos) && in_array($tipo, $modificacao->tipos)) selected @endif>
                    {{ $tipo->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="tags">Tags</label>
        <select id="tags" name="tags[]" class="form-control selectpicker" multiple data-live-search="true" title="Selecione as tags">
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}"
                    @if(!empty($modificacao->tags) && $modificacao->tags->contains($tag->id)) selected @endif>
                    {{ $tag->nome }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>
@endsection
