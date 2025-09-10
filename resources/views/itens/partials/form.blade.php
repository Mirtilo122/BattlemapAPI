<div class="mb-3">
    <label>Nome</label>
    <input type="text" name="nome" class="form-control" value="{{ old('nome', $item->nome ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Descrição</label>
    <textarea name="descricao" class="form-control">{{ old('descricao', $item->descricao ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Habilidade</label>
    <input type="text" name="habilidade" class="form-control" value="{{ old('habilidade', $item->habilidade ?? '') }}">
</div>

<div class="mb-3">
    <label>Imagem do Item</label>
    <input type="url" name="imagem_link" class="form-control" placeholder="Cole o link da imagem aqui" value="{{ old('imagem_link', $item?->imagem_link ?? '') }}">
</div>

<div class="mb-3">
    <label>Tipo</label>
    <select name="tipo_item_id" class="form-select" required>
        <option value="">Selecione</option>
        @foreach($tipos as $t)
            <option value="{{ $t->id }}" {{ old('tipo_item_id', $item->tipo_item_id ?? '') == $t->id ? 'selected' : '' }}>
                {{ $t->nome }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Subtipo</label>
    <select name="subtipo_id" class="form-select">
        <option value="">Selecione</option>
        @foreach($subtipos as $s)
            <option value="{{ $s->id }}" {{ old('subtipo_id', $item->subtipo_id ?? '') == $s->id ? 'selected' : '' }}>
                {{ $s->nome }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Originalidade</label>
    <select name="originalidade" class="form-select">
        <option value="Generico" {{ old('originalidade', $item->originalidade ?? '') == 'Generico' ? 'selected' : '' }}>Genérico</option>
        <option value="Unico" {{ old('originalidade', $item->originalidade ?? '') == 'Unico' ? 'selected' : '' }}>Único</option>
    </select>
</div>

<div class="mb-3">
    <label>Guia</label>
    <select name="guia" class="form-select">
        <option value="0" {{ old('guia', $item->guia ?? 0) == 0 ? 'selected' : '' }}>Não</option>
        <option value="1" {{ old('guia', $item->guia ?? 0) == 1 ? 'selected' : '' }}>Sim</option>
    </select>
</div>

<div class="mb-3">
    <label>Raridade</label>
    <input type="number" name="raridade" class="form-control" value="{{ old('raridade', $item->raridade ?? 1) }}">
</div>

<div class="mb-3">
    <label>Categoria</label>
    <select name="categoria" class="form-select">
        @foreach($categorias as $cat)
            <option value="{{ $cat }}" {{ old('categoria', $item->categoria ?? '') == $cat ? 'selected' : '' }}>
                {{ $cat }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Elemento</label>
    <select name="elemento" class="form-select">
        @foreach($elementos as $el)
            <option value="{{ $el }}" {{ old('elemento', $item->elemento ?? '') == $el ? 'selected' : '' }}>
                {{ $el }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Espaço</label>
    <input
        type="number"
        name="espaco"
        class="form-control"
        value="{{ old('espaco', $item->espaco ?? 1) }}"
        step="0.1"
        min="0">
</div>

<div class="mb-3">
    <label>Valor</label>
    <input type="number" name="valor" class="form-control" value="{{ old('valor', $item->valor ?? 0) }}">
</div>

<div class="mb-3">
    <label>Tags</label>
    <select name="tags[]" class="form-select" multiple>
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}"
                @if(collect(old('tags', $item?->tags?->pluck('id')->toArray() ?? []))->contains($tag->id)) selected @endif>
                {{ $tag->nome }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Modificações - Melhorias</label>
    <select name="melhorias[]" class="form-select" multiple>
        @foreach($melhorias as $m)
            <option value="{{ $m->id }}"
                @if(collect(old('melhorias', $item?->modificacoes?->pluck('id')->toArray() ?? []))->contains($m->id)) selected @endif>
                {{ $m->nome }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Modificações - Maldições</label>
    <select name="maldicoes[]" class="form-select" multiple>
        @foreach($maldicoes as $m)
            <option value="{{ $m->id }}"
                @if(collect(old('maldicoes', $item?->modificacoes?->pluck('id')->toArray() ?? []))->contains($m->id)) selected @endif>
                {{ $m->nome }}
            </option>
        @endforeach
    </select>
</div>

{{-- <div class="mb-3">
    <label>Dono (para itens únicos)</label>
    <select name="personagem_id" class="form-select">
        <option value="">Nenhum</option>
        @foreach($personagens as $p)
            <option value="{{ $p->id }}"
                {{ old('personagem_id', $item->personagens->first()?->id) }}>
                {{ $p->nome }}
            </option>
        @endforeach
    </select>
</div> --}}
