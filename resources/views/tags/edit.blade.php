@extends('layouts.app')

@section('content')
<h1>Editar Tag</h1>

<form action="{{ route('tags.update', $tag) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" value="{{ $tag->nome }}" required>
    </div>
    <div class="mb-3">
        <label>Descrição</label>
        <textarea name="descricao" class="form-control">{{ $tag->descricao }}</textarea>
    </div>
    <div class="mb-3">
        <label>Cor</label>
        <div class="input-group">
            <input type="color" class="form-control form-control-color" id="corPicker" value="{{ $tag->cor ?? '#000000' }}">
            <input type="text" name="cor" class="form-control" id="corInput" value="{{ $tag->cor }}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>

<script>
    const corPicker = document.getElementById('corPicker');
    const corInput = document.getElementById('corInput');

    corPicker.addEventListener('input', () => corInput.value = corPicker.value);
    corInput.addEventListener('input', () => {
        if(/^#([0-9A-F]{3}){1,2}$/i.test(corInput.value)) {
            corPicker.value = corInput.value;
        }
    });
</script>
@endsection
