@extends('layouts.app')

@section('content')
@php
    $user = auth()->user();

    $mapas = $user->acesso === 'dm'
        ? \App\Models\Mapa::all()
        : $user->mapas;
@endphp

<div class="row">
    @foreach($mapas as $mapa)
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $mapa->nome }}</h5>
                    <p class="card-text">{{ $mapa->descricao }}</p>
                    <a href="{{ route('battlemap.index', ['mapaId' => $mapa->id]) }}" class="btn btn-primary">
                        Acessar
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
