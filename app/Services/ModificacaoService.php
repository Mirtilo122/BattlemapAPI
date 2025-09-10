<?php

namespace App\Services;

use App\Models\Modificacao;

class ModificacaoService
{
    public function listar()
    {
        return Modificacao::with('tags')->get();
    }

    public function criar(array $data): Modificacao
    {
        $modificacao = Modificacao::create([
            'nome' => $data['nome'],
            'descricao' => $data['descricao'] ?? null,
            'habilidade' => $data['habilidade'] ?? null,
            'tipo' => $data['tipo'],
            'tipos' => $data['tipos'] ?? [],
        ]);

        if (!empty($data['tags'])) {
            $modificacao->tags()->sync($data['tags']);
        }

        return $modificacao->load('tags');
    }

    public function atualizar(int $id, array $data): Modificacao
    {
        $modificacao = Modificacao::findOrFail($id);

        $modificacao->update([
            'nome' => $data['nome'] ?? $modificacao->nome,
            'descricao' => $data['descricao'] ?? $modificacao->descricao,
            'habilidade' => $data['habilidade'] ?? $modificacao->habilidade,
            'tipo' => $data['tipo'] ?? $modificacao->tipo,
            'tipos' => $data['tipos'] ?? $modificacao->tipos,
        ]);

        if (isset($data['tags'])) {
            $modificacao->tags()->sync($data['tags']);
        }

        return $modificacao->load('tags');
    }

    public function deletar(int $id): bool
    {
        $modificacao = Modificacao::findOrFail($id);
        return $modificacao->delete();
    }

    public function listarPorTipo(string $tipo)
    {
        return Modificacao::with('tags')->where('tipo', $tipo)->paginate(10);
    }
}
