<?php

namespace App\Http\Controllers;

use App\Models\Personagem;
use App\Services\PersonagemService;
use Illuminate\Http\Request;

class PersonagemController extends Controller
{
    protected $service;

    public function __construct(PersonagemService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $personagens = Personagem::with('owner')->paginate(10);
        return view('personagens.index', compact('personagens'));
    }

    public function create()
    {
        return view('personagens.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'imagem_perfil' => 'nullable|string',
            'imagem_token' => 'required|string',
            'deslocamento' => 'required|integer',
        ]);

        $result = $this->service->store($validated);

        if (is_string($result)) {
            return redirect()->back()->with('error', $result);
        }

        return redirect()->route('personagens.index')->with('success', 'Personagem criado!');
    }

    public function show(Personagem $personagem)
    {
        return view('personagens.show', compact('personagem'));
    }

    public function edit(Personagem $personagem)
    {
        return view('personagens.edit', compact('personagem'));
    }

    public function update(Request $request, Personagem $personagem)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'imagem_perfil' => 'nullable|string',
            'imagem_token' => 'required|string',
            'deslocamento' => 'required|integer',
        ]);

        $result = $this->service->update($personagem, $validated);

        if (is_string($result)) {
            return redirect()->back()->with('error', $result);
        }

        return redirect()->route('personagens.index')->with('success', 'Personagem atualizado!');
    }

    public function destroy(Personagem $personagem)
    {
        $result = $this->service->delete($personagem);

        if (is_string($result) && str_contains($result, 'permissão')) {
            return redirect()->back()->with('error', $result);
        }

        return redirect()->route('personagens.index')->with('success', $result);
    }
}
