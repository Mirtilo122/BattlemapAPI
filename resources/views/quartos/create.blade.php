@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Quarto</h1>
    <form action="{{ route('quartos.store', ['mapaId' => $mapaId]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="x" class="form-label">Dimensão X</label>
            <input type="number" name="x" class="form-control" min="1" required>
        </div>
        <div class="mb-3">
            <label for="y" class="form-label">Dimensão Y</label>
            <input type="number" name="y" class="form-control" min="1" required>
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" name="inicial" class="form-check-input" id="inicial">
            <label for="inicial" class="form-check-label">Quarto Inicial</label>
        </div>
        <button type="submit" class="btn btn-success">Criar</button>
        <a href="{{ route('quartos.index', ['mapaId' => $mapaId]) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
