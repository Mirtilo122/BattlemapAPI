@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Quarto: {{ $quarto->nome }}</h1>

    <form action="{{ route('quartos.update', ['mapaId' => $quarto->mapa_id, 'quarto' => $quarto->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ $quarto->nome }}" required>
        </div>
        <div class="mb-3">
            <label for="x" class="form-label">Dimensão X</label>
            <input type="number" name="x" class="form-control" value="{{ $quarto->x }}" min="1" required>
        </div>
        <div class="mb-3">
            <label for="y" class="form-label">Dimensão Y</label>
            <input type="number" name="y" class="form-control" value="{{ $quarto->y }}" min="1" required>
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" name="inicial" class="form-check-input" id="inicial" {{ $quarto->inicial ? 'checked' : '' }}>
            <label for="inicial" class="form-check-label">Quarto Inicial</label>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('quartos.index', ['mapaId' => $quarto->mapa_id]) }}" class="btn btn-secondary">Cancelar</a>
    </form>

    <hr>
    <h3>Portas do Quarto</h3>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCriarPorta">Adicionar Porta</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Quarto A</th>
                <th>Quarto B</th>
                <th>Coord A (X,Y)</th>
                <th>Coord B (X,Y)</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($portas as $porta)
            <tr>
                <td>{{ $porta->quartoA->nome }}</td>
                <td>{{ $porta->quartoB->nome }}</td>
                <td>{{ $porta->qax }}, {{ $porta->qay }}</td>
                <td>{{ $porta->qbx }}, {{ $porta->qby }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditarPorta{{ $porta->id }}">Editar</button>
                    {{-- <form action="{{ route('portas.destroy', ['mapaId' => $porta->quartoA->mapa_id, 'porta' => $porta->id]) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Deseja deletar esta porta?')">Deletar</button>
                    </form> --}}
                </td>
            </tr>

            <!-- Modal Editar Porta -->
            <div class="modal fade" id="modalEditarPorta{{ $porta->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('portas.update', ['mapaId' => $porta->mapa_id, 'porta' => $porta->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Porta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label>Coord A X</label>
                                    <input type="number" name="qax" class="form-control" value="{{ $porta->qax }}" required>
                                </div>
                                <div class="mb-2">
                                    <label>Coord A Y</label>
                                    <input type="number" name="qay" class="form-control" value="{{ $porta->qay }}" required>
                                </div>
                                <div class="mb-2">
                                    <label>Coord B X</label>
                                    <input type="number" name="qbx" class="form-control" value="{{ $porta->qbx }}" required>
                                </div>
                                <div class="mb-2">
                                    <label>Coord B Y</label>
                                    <input type="number" name="qby" class="form-control" value="{{ $porta->qby }}" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Salvar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Criar Porta -->
<div class="modal fade" id="modalCriarPorta" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('portas.store', ['mapaId' => $quarto->mapa_id, 'quarto' => $quarto->id]) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Criar Porta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="qa_id" value="{{ $quarto->id }}">
                    <div class="mb-2">
                        <label>Quarto B</label>
                        <select name="qb_id" class="form-select" required>
                            @foreach(\App\Models\Quarto::where('mapa_id', $quarto->mapa_id)->where('id', '!=', $quarto->id)->get() as $q)
                                <option value="{{ $q->id }}">{{ $q->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Coord A X</label>
                        <input type="number" name="qax" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Coord A Y</label>
                        <input type="number" name="qay" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Coord B X</label>
                        <input type="number" name="qbx" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Coord B Y</label>
                        <input type="number" name="qby" class="form-control" required>
                    </div>
                    <input type="hidden" name="mapa_id" value="{{ $quarto->mapa_id }}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Criar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
