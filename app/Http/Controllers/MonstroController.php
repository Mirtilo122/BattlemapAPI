<?php

namespace App\Http\Controllers;

use App\Models\Monstro;
use App\Services\MonstroService;
use Illuminate\Http\Request;

class MonstroController extends Controller
{
    protected $service;

    public function __construct(MonstroService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $monstros = Monstro::paginate(10);
        return view('monstros.index', compact('monstros'));
    }

    public function create()
    {
        return view('monstros.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'deslocamento_base' => 'required|integer',
            'imagem_perfil' => 'nullable|string',
            'imagem_token' => 'required|string',
        ]);

        $result = $this->service->store($validated);

        if (is_string($result)) {
            return redirect()->back()->with('error', $result);
        }

        return redirect()->route('monstros.index')->with('success', 'Monstro criado!');
    }

    public function show(Monstro $monstro)
    {
        return view('monstros.show', compact('monstro'));
    }

    public function edit(Monstro $monstro)
    {
        return view('monstros.edit', compact('monstro'));
    }

    public function update(Request $request, Monstro $monstro)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'deslocamento_base' => 'required|integer',
            'imagem_perfil' => 'nullable|string',
            'imagem_token' => 'required|string',
        ]);

        $result = $this->service->update($monstro, $validated);

        if (is_string($result)) {
            return redirect()->back()->with('error', $result);
        }

        return redirect()->route('monstros.index')->with('success', 'Monstro atualizado!');
    }

    public function destroy(Monstro $monstro)
    {
        $result = $this->service->delete($monstro);

        if (is_string($result) && str_contains($result, 'Apenas')) {
            return redirect()->back()->with('error', $result);
        }

        return redirect()->route('monstros.index')->with('success', $result);
    }
}
