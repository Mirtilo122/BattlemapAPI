@extends('layouts.app')

@section('content')
<h2>{{ $mapa->nome }}</h2>
<p>{{ $mapa->descricao }}</p>

<hr>

<h4>Usuários vinculados</h4>
<form action="{{ route('mapas.vincularUsuarios', $mapa) }}" method="POST">
    @csrf
    <div class="mb-3">
        <select name="usuarios[]" class="form-select" multiple>
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}"
                    {{ in_array($usuario->id, $vinculados) ? 'selected' : '' }}>
                    {{ $usuario->name }} ({{ $usuario->acesso }})
                </option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-primary">Vincular Usuários</button>
</form>
@endsection
