<?php

namespace App\Http\Controllers;

use App\Services\TipoSubtipoService;
use App\Models\TipoItem;
use App\Models\Subtipo;
use Illuminate\Http\Request;

class TipoSubtipoController extends Controller
{
    protected $service;

    public function __construct(TipoSubtipoService $service)
    {
        $this->service = $service;
    }

    // INDEX compartilhado para tipos e subtipos
    public function index()
    {
        $tipos = $this->service->listarTipos();
        $subtipos = $this->service->listarSubtipos();

        return view('tipos_subtipos.index', compact('tipos', 'subtipos'));
    }

    // CREATE e EDIT para tipos
    public function createTipo()
    {
        return view('tipos_subtipos.create_tipo');
    }

    public function storeTipo(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $this->service->criarTipo($data);

        return redirect()->route('tipos_subtipos.index')->with('success', 'Tipo criado!');
    }

    public function editTipo(TipoItem $tipo)
    {
        return view('tipos_subtipos.edit_tipo', compact('tipo'));
    }

    public function updateTipo(Request $request, TipoItem $tipo)
    {
        $data = $request->validate([
            'nome' => 'sometimes|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $this->service->atualizarTipo($tipo->id, $data);

        return redirect()->route('tipos_subtipos.index')->with('success', 'Tipo atualizado!');
    }

    public function destroyTipo(TipoItem $tipo)
    {
        $this->service->deletarTipo($tipo->id);
        return redirect()->route('tipos_subtipos.index')->with('success', 'Tipo excluído!');
    }

    // CREATE e EDIT para subtipos
    public function createSubtipo()
    {
        $tipos = TipoItem::all();
        return view('tipos_subtipos.create_subtipo', compact('tipos'));
    }

    public function storeSubtipo(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'tipo_item_id' => 'required|exists:tipos_itens,id',
        ]);

        $this->service->criarSubtipo($data);

        return redirect()->route('tipos_subtipos.index')->with('success', 'Subtipo criado!');
    }

    public function editSubtipo(Subtipo $subtipo)
    {
        $tipos = TipoItem::all();
        return view('tipos_subtipos.edit_subtipo', compact('subtipo', 'tipos'));
    }

    public function updateSubtipo(Request $request, Subtipo $subtipo)
    {
        $data = $request->validate([
            'nome' => 'sometimes|string|max:255',
            'descricao' => 'nullable|string',
            'tipo_item_id' => 'required|exists:tipos_itens,id',
        ]);

        $this->service->atualizarSubtipo($subtipo->id, $data);

        return redirect()->route('tipos_subtipos.index')->with('success', 'Subtipo atualizado!');
    }

    public function destroySubtipo(Subtipo $subtipo)
    {
        $this->service->deletarSubtipo($subtipo->id);
        return redirect()->route('tipos_subtipos.index')->with('success', 'Subtipo excluído!');
    }
}
