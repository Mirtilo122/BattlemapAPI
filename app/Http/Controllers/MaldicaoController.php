<?php

namespace App\Http\Controllers;

use App\Services\ModificacaoService;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\TipoItem;
use App\Models\Modificacao;

class MaldicaoController extends Controller
{
    protected $service;
    protected $tipo = 'Maldicao';

    public function __construct(ModificacaoService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $modificacoes = $this->service->listarPorTipo($this->tipo);
        $tipo = "maldicoes";
        return view('modificacoes.index', compact('modificacoes', 'tipo'));
    }

    public function create() 
    {
        $tags = Tag::all();
        $tiposItens = TipoItem::all();
        return view('modificacoes.create', compact('tags', 'tiposItens'))->with('tipo', 'maldicoes');
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
        return redirect()->route('maldicoes.index')->with('success', 'Maldição criada!');
    }

    public function show(Modificacao $maldicao)
    {
        return view('modificacoes.show', ['modificacao' => $maldicao]);
    }

    public function edit(Modificacao $maldicao)
    {
        $tags = Tag::all();
        $tiposItens = TipoItem::all();
        $modificacao = $maldicao;
        return view('modificacoes.edit', compact('modificacao', 'tags', 'tiposItens'))->with('tipo', 'maldicoes');
    }

    public function update(Request $request, Modificacao $maldicao)
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

        $this->service->atualizar($maldicao->id, $data);
        return redirect()->route('maldicoes.index')->with('success', 'Maldição atualizada!');
    }

    public function destroy(Modificacao $maldicao)
    {
        $this->service->deletar($maldicao->id);
        return redirect()->route('maldicoes.index')->with('success', 'Maldição excluída!');
    }
}
