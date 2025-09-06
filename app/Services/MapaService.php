<?php

namespace App\Services;

use App\Models\Mapa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MapaService
{
    /**
     * Criar um mapa (somente DM)
     */
    public function store(array $data): Mapa
    {
        $user = Auth::user();

        if ($user->acesso !== 'dm') {
            throw new \Exception('Apenas DMs podem criar mapas.');
        }

        return Mapa::create([
            'nome' => $data['nome'],
            'descricao' => $data['descricao'] ?? null,
        ]);
    }

    /**
     * Atualizar um mapa (somente DM)
     */
    public function update(Mapa $mapa, array $data): Mapa
    {
        $user = Auth::user();

        if ($user->acesso !== 'dm') {
            throw new \Exception('Apenas DMs podem editar mapas.');
        }

        $mapa->update([
            'nome' => $data['nome'] ?? $mapa->nome,
            'descricao' => $data['descricao'] ?? $mapa->descricao,
        ]);

        return $mapa;
    }

    /**
     * Vincular usuários a um mapa (somente DM)
     */
    public function vincularUsuarios(Mapa $mapa, array $userIds): void
    {
        $user = Auth::user();

        if ($user->acesso !== 'dm') {
            throw new \Exception('Apenas DMs podem vincular usuários a mapas.');
        }

        $mapa->users()->sync($userIds); // atualiza vínculos
    }

    /**
     * Retorna os mapas visíveis para o usuário atual
     * - DM: vê todos
     * - Jogador: apenas os vinculados
     */
    public function getMapasVisiveis()
    {
        $user = Auth::user();

        if ($user->acesso === 'dm') {
            return Mapa::all();
        }

        return $user->mapas;
    }
}
