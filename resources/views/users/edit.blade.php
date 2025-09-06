@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Usuário</h1>
    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>
        <div class="mb-3">
            <label>Senha (deixe em branco para não alterar)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label>Acesso</label>
            <select name="acesso" class="form-select">
                <option value="jogador" @if($user->acesso == 'jogador') selected @endif>Jogador</option>
                <option value="dm" @if($user->acesso == 'dm') selected @endif>DM</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>
</div>
@endsection
