@extends('layouts.app')

@section('content')
<h1>{{ $personagem->nome }}</h1>

<p><strong>Descrição:</strong> {{ $personagem->descricao }}</p>

@if($personagem->imagem_perfil)
    <p><strong>Imagem de Perfil:</strong></p>
    <img src="{{ $personagem->imagem_perfil }}" alt="perfil" width="150">
@endif

<p><strong>Token:</strong></p>
<img src="{{ $personagem->imagem_token }}" alt="token" width="100">

<p><strong>Deslocamento:</strong> {{ $personagem->deslocamento }}</p>
<p><strong>Dono:</strong> {{ $personagem->owner->name }}</p>
@endsection
