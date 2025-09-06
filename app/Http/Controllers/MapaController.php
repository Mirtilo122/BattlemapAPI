<?php

namespace App\Http\Controllers;

use App\Models\Mapa;
use App\Models\User;
use App\Services\MapaService;
use Illuminate\Http\Request;

class MapaController extends Controller
{
    protected MapaService $mapaService;

    public function __construct(MapaService $mapaService)
    {
        $this->mapaService = $mapaService;
    }

    public function index()
    {
        $mapas = $this->mapaService->getMapasVisiveis();
        return view('mapas.index', compact('mapas'));
    }

    public function create()
    {
        return view('mapas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        try {
            $this->mapaService->store($request->all());
            return redirect()->route('mapas.index')->with('success', 'Mapa criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show(Mapa $mapa)
    {
        $usuarios = User::all();
        $vinculados = $mapa->users->pluck('id')->toArray();

        return view('mapas.show', compact('mapa', 'usuarios', 'vinculados'));
    }

    public function edit(Mapa $mapa)
    {
        return view('mapas.edit', compact('mapa'));
    }

    public function update(Request $request, Mapa $mapa)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        try {
            $this->mapaService->update($mapa, $request->all());
            return redirect()->route('mapas.index')->with('success', 'Mapa atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Mapa $mapa)
    {
        $mapa->delete();
        return redirect()->route('mapas.index')->with('success', 'Mapa deletado com sucesso!');
    }

    public function vincularUsuarios(Request $request, Mapa $mapa)
    {
        $request->validate([
            'usuarios' => 'array',
            'usuarios.*' => 'exists:users,id',
        ]);

        try {
            $this->mapaService->vincularUsuarios($mapa, $request->input('usuarios', []));
            return redirect()->route('mapas.show', $mapa)->with('success', 'Usuários vinculados com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
