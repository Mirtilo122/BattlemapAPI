<?php

namespace App\Http\Controllers;

use App\Services\TagService;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    protected $service;

    public function __construct(TagService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $tags = $this->service->listar();
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'cor' => 'nullable|string|max:20',
        ]);

        $this->service->criar($data);

        return redirect()->route('tags.index')
            ->with('success', 'Tag criada com sucesso!');
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'cor' => 'nullable|string|max:20',
        ]);

        $this->service->atualizar($id, $data);

        return redirect()->route('tags.index')
            ->with('success', 'Tag atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $this->service->deletar($id);

        return redirect()->route('tags.index')
            ->with('success', 'Tag deletada com sucesso!');
    }
}
