@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes do Usuário</h1>
    <ul>
        <li><strong>Nome:</strong> {{ $user->name }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Acesso:</strong> {{ ucfirst($user->acesso) }}</li>
    </ul>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
