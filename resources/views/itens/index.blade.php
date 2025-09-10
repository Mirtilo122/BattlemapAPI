@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Itens</h1>
        <a href="{{ route('itens.create') }}" class="btn btn-success">Novo Item</a>
    </div>

    <form method="GET" action="{{ route('itens.index') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control"
                   placeholder="Pesquisar..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <select name="subtipo" class="form-select">
                <option value="">Subtipo</option>
                @foreach($subtipos as $s)
                    <option value="{{ $s->id }}" {{ request('subtipo') == $s->id ? 'selected' : '' }}>
                        {{ $s->nome }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="categoria" class="form-select">
                <option value="">Categoria</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat }}" {{ request('categoria') == $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="elemento" class="form-select">
                @foreach($elementos as $el)
                    <option value="{{ $el }}" {{ request('elemento') == $el ? 'selected' : '' }}>
                        {{ $el }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="tag" class="form-select">
                <option value="">Tag</option>
                @foreach($tags as $t)
                    <option value="{{ $t->id }}" {{ request('tag') == $t->id ? 'selected' : '' }}>
                        {{ $t->nome }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>

    <ul class="nav nav-tabs mb-3" id="itemTabs" role="tablist">
        @foreach($itensPorTipo as $tipo => $paginados)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                        id="tab-{{ Str::slug($tipo) }}"
                        data-bs-toggle="tab"
                        data-bs-target="#pane-{{ Str::slug($tipo) }}"
                        type="button" role="tab">
                    {{ $tipo }}
                </button>
            </li>
        @endforeach
    </ul>

    <div class="tab-content" id="itemTabsContent">
        @foreach($itensPorTipo as $tipo => $paginados)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                 id="pane-{{ Str::slug($tipo) }}" role="tabpanel">

                <div class="row">
                    @forelse($paginados as $item)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                @if(!empty($item->imagem))
                                    <img src="{{ $item->imagem }}" class="card-img-top" alt="{{ $item->nome }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->nome }}</h5>
                                    <p class="card-text">
                                        <strong>{{ $item->tipo->nome ?? '' }}</strong>
                                        - {{ $item->subtipo->nome ?? '' }}<br>
                                        Categoria: {{ $item->categoria }}<br>
                                        Valor: {{ $item->valor }} moedas<br>
                                        Elemento: {{ $item->elemento }}
                                    </p>
                                    <p>{{ $item->descricao }}</p>
                                    <p>
                                        @foreach($item->tags as $tag)
                                            <span class="badge bg-secondary">{{ $tag->nome }}</span>
                                        @endforeach
                                    </p>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <a href="{{ route('itens.show', $item) }}" class="btn btn-sm btn-info">Ver</a>
                                    <a href="{{ route('itens.edit', $item) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('itens.destroy', $item) }}" method="POST" onsubmit="return confirm('Deseja excluir?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Nenhum item encontrado.</p>
                    @endforelse
                </div>

                <div class="mt-3">
                    {{ $paginados->links() }}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
