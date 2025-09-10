<?php

namespace App\Http\Controllers;

use App\Models\Quarto;
use App\Models\Porta;
use App\Services\QuartoService;
use Illuminate\Http\Request;

class QuartoController extends Controller
{
    protected $service;

    public function __construct(QuartoService $service)
    {
        $this->service = $service;
    }

    // Lista quartos de um mapa
    public function index($mapaId)
    {
        $quartos = $this->service->listarQuartosPorMapa($mapaId);
        return view('quartos.index', compact('quartos', 'mapaId'));
    }

    public function create($mapaId)
    {
        return view('quartos.create', compact('mapaId'));
    }

    // Armazena novo quarto
    public function store(Request $request, $mapaId)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'x' => 'required|integer|min:1',
            'y' => 'required|integer|min:1',
        ]);
        $dados['mapa_id'] = $mapaId;

        $this->service->criarQuarto($dados);

        return redirect()->route('quartos.index', $mapaId)->with('success', 'Quarto criado com sucesso');
    }

    // Formulário de edição de quarto
    public function edit($mapaId, $quartoId)
    {
        $quarto = Quarto::where('mapa_id', $mapaId)->findOrFail($quartoId);
        $portas = $this->service->listarPortas($quarto);

        return view('quartos.edit', compact('quarto', 'portas', 'mapaId'));
    }

    // Atualiza quarto
    public function update(Request $request, $mapaId, $quartoId)
    {
        $quarto = Quarto::where('mapa_id', $mapaId)->findOrFail($quartoId);

        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'x' => 'required|integer|min:1',
            'y' => 'required|integer|min:1',
            'inicial' => 'nullable|boolean',
        ]);

        $this->service->atualizarQuarto($quarto, $dados);

        return redirect()->route('quartos.index', $mapaId)->with('success', 'Quarto atualizado');
    }

    // Deleta quarto
    public function destroy($mapaId, $quartoId)
    {
        $quarto = Quarto::where('mapa_id', $mapaId)->findOrFail($quartoId);
        $this->service->deletarQuarto($quarto);

        return redirect()->route('quartos.index', $mapaId)->with('success', 'Quarto deletado');
    }

    // Portas via modal
    public function storePorta(Request $request, $mapaId, $quartoId)
    {
        $dados = $request->validate([
            'qa_id' => 'required|integer|exists:quartos,id',
            'qb_id' => 'required|integer|exists:quartos,id',
            'qax' => 'required|integer|min:0',
            'qay' => 'required|integer|min:0',
            'qbx' => 'required|integer|min:0',
            'qby' => 'required|integer|min:0',
            'mapa_id' => 'required|integer|exists:mapas,id',
        ]);

        $this->service->criarPorta($dados);

        return redirect()->back()->with('success', 'Porta criada');
    }

    public function updatePorta(Request $request, $mapaId, $portaId)
    {
        $porta = Porta::where('mapa_id', $mapaId)->findOrFail($portaId);

        $dados = $request->validate([
            'qax' => 'required|integer|min:0',
            'qay' => 'required|integer|min:0',
            'qbx' => 'required|integer|min:0',
            'qby' => 'required|integer|min:0',
        ]);

        $this->service->atualizarPorta($porta, $dados);

        return redirect()->back()->with('success', 'Porta atualizada');
    }

    public function destroyPorta($mapaId, $portaId)
    {
        $porta = Porta::where('mapa_id', $mapaId)->findOrFail($portaId);
        $this->service->deletarPorta($porta);

        return redirect()->back()->with('success', 'Porta deletada');
    }
}
