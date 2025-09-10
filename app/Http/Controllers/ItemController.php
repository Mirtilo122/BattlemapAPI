<?php

namespace App\Http\Controllers;

use App\Models\TipoItem;
use App\Models\Subtipo;
use App\Models\Tag;
use App\Models\Modificacao;
use App\Models\Personagem;
use App\Models\Item;
use App\Services\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    private ItemService $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function index(Request $request)
    {
        $filtros = $request->only(['search', 'subtipo', 'categoria', 'valor', 'elemento', 'tag']);
        $itensPorTipo = $this->itemService->listarPorTipoComFiltros($filtros);

        $subtipos = Subtipo::all();
        $tags = Tag::all();
        $categorias = ['I','II','III','IV','V','VI','VII','VIII','IX','X'];
        $elementos = ['Todos','Nenhum','Morte','Sangue','Conhecimento','Energia','Medo'];

        return view('itens.index', compact('itensPorTipo','subtipos','tags','categorias','elementos'));
    }

    public function create()
    {
        $tipos = TipoItem::all();

        $subtipos = Subtipo::all();
        $tags = Tag::all();
        $categorias = ['I','II','III','IV','V','VI','VII','VIII','IX','X'];
        $elementos = ['Todos','Nenhum','Morte','Sangue','Conhecimento','Energia','Medo'];

        $melhorias = Modificacao::where('tipo', 'melhoria')->get();
        $maldicoes = Modificacao::where('tipo', 'maldicao')->get();

        $personagens = Personagem::all();

        return view('itens.create', compact(
            'tipos',
            'subtipos',
            'tags',
            'melhorias',
            'maldicoes',
            'personagens',
            'categorias',
            'elementos'
        ));
    }

    public function store(Request $request)
    {
        $this->itemService->criar($request->all());
        return redirect()->route('itens.index')->with('success', 'Item criado com sucesso.');
    }

    public function edit(Item $item)
    {
        $tipos = TipoItem::all();
        $subtipos = Subtipo::all();
        $tags = Tag::all();
        $categorias = ['I','II','III','IV','V','VI','VII','VIII','IX','X'];
        $elementos = ['Todos','Nenhum','Morte','Sangue','Conhecimento','Energia','Medo'];

        $melhorias = Modificacao::where('tipo', 'melhoria')->get();
        $maldicoes = Modificacao::where('tipo', 'maldicao')->get();

        $personagens = Personagem::all();

        return view('itens.edit', compact(
            'item',
            'tipos',
            'subtipos',
            'tags',
            'melhorias',
            'maldicoes',
            'personagens',
            'categorias',
            'elementos'
        ));
    }

    public function update(Request $request, Item $item)
    {
        $this->itemService->atualizar($item->id, $request->all());
        return redirect()->route('itens.index')->with('success', 'Item atualizado com sucesso.');
    }

    public function destroy(Item $item)
    {
        $this->itemService->deletar($item->id);
        return redirect()->route('itens.index')->with('success', 'Item removido com sucesso.');
    }

    public function show(Item $item)
    {
        $item = $this->itemService->show($item->id);

        return view('itens.show', compact('item'));
    }
}
