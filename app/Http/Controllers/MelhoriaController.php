<?php

namespace App\Http\Controllers;

use App\Services\ModificacaoService;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\TipoItem;
use App\Models\Modificacao;

class MelhoriaController extends Controller
{
    protected $service;
    protected $tipo = 'Melhoria';

    public function __construct(ModificacaoService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $modificacoes = $this->service->listarPorTipo($this->tipo);
        $tipo = "melhorias";
        return view('modificacoes.index', compact('modificacoes', 'tipo'));
    }

    public function create()
    {
        $tags = Tag::all();
        $tiposItens = TipoItem::all();
        return view('modificacoes.create', compact('tags', 'tiposItens'))->with('tipo', 'melhorias');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'habilidade' => 'nullable|string',
            'tipos' => 'nullable|array',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id',
        ]);

        $data['tipo'] = $this->tipo;

        $mod = $this->service->criar($data);
        return redirect()->route('melhorias.index')->with('success', 'Melhoria criada!');
    }

    public function show(Modificacao $melhoria)
    {
        return view('modificacoes.show', ['modificacao' => $melhoria]);
    }

    public function edit(Modificacao $melhoria)
    {
        $tags = Tag::all();
        $tiposItens = TipoItem::all();
        $modificacao = $melhoria;
        return view('modificacoes.edit', compact('modificacao', 'tags', 'tiposItens'))->with('tipo', 'melhorias');
    }

    public function update(Request $request, Modificacao $melhoria)
    {
        $data = $request->validate([
            'nome' => 'sometimes|string|max:255',
            'descricao' => 'nullable|string',
            'habilidade' => 'nullable|string',
            'tipos' => 'nullable|array',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id',
        ]);

        $data['tipo'] = $this->tipo;

        $this->service->atualizar($melhoria->id, $data);
        return redirect()->route('melhorias.index')->with('success', 'Melhoria atualizada!');
    }

    public function destroy(Modificacao $melhoria)
    {
        $this->service->deletar($melhoria->id);
        return redirect()->route('melhorias.index')->with('success', 'Melhoria excluída!');
    }
}
