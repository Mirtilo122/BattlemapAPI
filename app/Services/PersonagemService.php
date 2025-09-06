<?php

namespace App\Services;

use App\Models\Personagem;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 

class PersonagemService
{
    public function store(array $data): Personagem|string
    {
        $user = Auth::user();

        if (!$user) {
            return "Usuário não autenticado.";
        }
        
        if ($user->acesso === 'jogador' && $user->personagens()->count() >= 10) {
            return "Você já possui muitos personagens (limite 10).";
        }

        $data['owner_id'] = $user->id;

        return Personagem::create($data);
    }

    public function update(Personagem $personagem, array $data): Personagem|string
    {
        $user = Auth::user();

        if (!$user) {
            return "Usuário não autenticado.";
        }

        if ($user->acesso !== 'dm' && $personagem->owner_id !== $user->id) {
            return "Você não tem permissão para editar este personagem.";
        }

        $personagem->update($data);
        return $personagem;
    }

    public function delete(Personagem $personagem): string
    {
        $user = Auth::user();

        if (!$user) {
            return "Usuário não autenticado.";
        }

        if ($user->acesso !== 'dm' && $personagem->owner_id !== $user->id) {
            return "Você não tem permissão para excluir este personagem.";
        }

        $personagem->delete();
        return "Personagem excluído com sucesso.";
    }
}
