@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $item->nome }}</h1>

    <div class="card mb-4">
        @if(!empty($item->imagem))
            <img src="{{ $item->imagem }}" class="card-img" alt="{{ $item->nome }}">
        @endif
        <div class="card-body">
            <p><strong>Tipo:</strong> {{ $item->tipo->nome ?? 'Sem Tipo' }}</p>
            <p><strong>Subtipo:</strong> {{ $item->subtipo->nome ?? 'Sem Subtipo' }}</p>
            <p><strong>Categoria:</strong> {{ $item->categoria }}</p>
            <p><strong>Valor:</strong> {{ $item->valor }} moedas</p>
            <p><strong>Elemento:</strong> {{ $item->elemento }}</p>
            <p><strong>Descrição:</strong> {{ $item->descricao }}</p>
            <p><strong>Habilidade:</strong> {{ $item->habilidade }}</p>
            <p><strong>Originalidade:</strong> {{ ucfirst($item->originalidade) }}</p>
            <p><strong>Guia:</strong> {{ $item->guia ? 'Sim' : 'Não' }}</p>
            <p><strong>Raridade:</strong> {{ $item->raridade }}</p>
            <p><strong>Espaço:</strong> {{ $item->espaco }}</p>

            <p><strong>Tags:</strong>
                @foreach($item->tags as $tag)
                    <span class="badge" style="background-color: {{ $tag->cor }}">{{ $tag->nome }}</span>
                @endforeach
            </p>

            <p><strong>Modificações:</strong>
                @foreach($item->modificacoes as $mod)
                    <span class="badge bg-info">{{ $mod->nome }}</span>
                @endforeach
            </p>

            @if($item->arma)
                <hr>
                <h4>Informações de Arma</h4>
                <p><strong>Dano Base:</strong> {{ $item->arma->dano_base }}</p>
                <p><strong>Crítico:</strong> {{ $item->arma->margem_critico_base }} / {{ $item->arma->multiplicador_critico_base }}</p>
                <p><strong>Arma Base:</strong> {{ $item->arma->arma_base ?? 'Nenhuma' }}</p>
                <p><strong>Munição:</strong> {{ $item->arma->municao ? 'Sim' : 'Não' }}</p>
                @if($item->arma->municoes->count())
                    <p><strong>Munições:</strong></p>
                    <ul>
                        @foreach($item->arma->municoes as $municao)
                            <li>{{ $municao->municao->nome }} ({{ $municao->atual }}/{{ $municao->maximo }})</li>
                        @endforeach
                    </ul>
                @endif
            @endif

            <p><strong>Dono:</strong>
                {{ $item->personagens->first()->nome ?? 'Desconhecido' }}
            </p>
        </div>
    </div>

    <a href="{{ route('itens.index') }}" class="btn btn-secondary">Voltar</a>
    <a href="{{ route('itens.edit', $item) }}" class="btn btn-warning">Editar</a>
</div>
@endsection
