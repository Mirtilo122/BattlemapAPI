@extends('layouts.app')

@section('content')
<h1>{{ $monstro->nome }}</h1>

@if($monstro->imagem_perfil)
    <p><strong>Imagem de Perfil:</strong></p>
    <img src="{{ $monstro->imagem_perfil }}" alt="perfil" width="150">
@endif

<p><strong>Token:</strong></p>
<img src="{{ $monstro->imagem_token }}" alt="token" width="100">

<p><strong>Deslocamento Base:</strong> {{ $monstro->deslocamento_base }}</p>
@endsection
