@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>{{ $modificacao->tipo }}: {{ $modificacao->nome }}</h1>
    <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#tagsHelp" aria-expanded="false" aria-controls="tagsHelp">
        ?
    </button>
</div>

<p>{{ $modificacao->descricao }}</p>

@if($modificacao->habilidade)
    <p><strong>Habilidade:</strong> {{ $modificacao->habilidade }}</p>
@endif

<h4>Tags</h4>
@if($modificacao->tags->isEmpty())
    <p>Não possui tags.</p>
@else
    <div class="mb-3">
        @foreach($modificacao->tags as $tag)
            <span class="badge me-1" style="background-color: {{ $tag->cor }};">{{ $tag->nome }}</span>
        @endforeach
    </div>
@endif

<!-- Lista de ajuda das tags -->
<div class="collapse mt-2" id="tagsHelp">
    <div class="card card-body">
        <h5>Lista de Tags</h5>
        @foreach($modificacao->tags as $tag)
            <p>
                <span class="badge me-1" style="background-color: {{ $tag->cor }};">{{ $tag->nome }}</span>
                - {{ $tag->descricao }}
            </p>
        @endforeach
    </div>
</div>

<a href="{{ $modificacao->tipo === 'Melhoria' ? route('melhorias.index') : route('maldicoes.index') }}" class="btn btn-secondary mt-3">Voltar</a>
@endsection
