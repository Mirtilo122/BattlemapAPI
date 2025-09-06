@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Quartos do Mapa {{ $mapaId }}</h1>
    <a href="{{ route('quartos.create', ['mapaId' => $mapaId]) }}" class="btn btn-primary mb-3">Criar Quarto</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Dimensão</th>
                <th>Inicial</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quartos as $quarto)
            <tr>
                <td>{{ $quarto->nome }}</td>
                <td>{{ $quarto->x }} x {{ $quarto->y }}</td>
                <td>{{ $quarto->inicial ? 'Sim' : 'Não' }}</td>
                <td>
                    <a href="{{ route('quartos.edit', ['mapaId' => $mapaId, 'quarto' => $quarto->id]) }}" class="btn btn-sm btn-warning">Editar</a>

                    <form action="{{ route('quartos.destroy', ['mapaId' => $mapaId, 'quarto' => $quarto->id]) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Tem certeza que deseja deletar este quarto?')">Deletar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
