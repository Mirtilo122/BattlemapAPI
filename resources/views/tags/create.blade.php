@extends('layouts.app')

@section('content')
<h1>Criar Tag</h1>

<form action="{{ route('tags.store') }}" method="POST">
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
        <label>Cor</label>
        <div class="input-group">
            <input type="color" class="form-control form-control-color" id="corPicker" value="#ff0000">
            <input type="text" name="cor" class="form-control" id="corInput" placeholder="#ff0000 ou red">
        </div>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
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
