@extends('layouts.app')

@section('content')
<h1>Tipos e Subtipos de Itens</h1>

<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#tipos-tab">Tipos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#subtipos-tab">Subtipos</a>
    </li>
</ul>

<div class="tab-content">
    <!-- Tipos -->
    <div class="tab-pane fade show active" id="tipos-tab">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('tipos.create') }}" class="btn btn-primary">Novo Tipo</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Subtipos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tipos as $tipo)
                    <tr>
                        <td>{{ $tipo->nome }}</td>
                        <td>{{ $tipo->descricao }}</td>
                        <td>{{ $tipo->subtipos->pluck('nome')->join(', ') }}</td>
                        <td>
                            <a href="{{ route('tipos.edit', $tipo) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('tipos.destroy', $tipo) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $tipos->links() }}
    </div>

    <!-- Subtipos -->
    <div class="tab-pane fade" id="subtipos-tab">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('subtipos.create') }}" class="btn btn-primary">Novo Subtipo</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Tipo Pai</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subtipos as $subtipo)
                    <tr>
                        <td>{{ $subtipo->nome }}</td>
                        <td>{{ $subtipo->descricao }}</td>
                        <td>{{ $subtipo->tipoItem->nome }}</td>
                        <td>
                            <a href="{{ route('subtipos.edit', $subtipo) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('subtipos.destroy', $subtipo) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $subtipos->links() }}
    </div>
</div>
@endsection
