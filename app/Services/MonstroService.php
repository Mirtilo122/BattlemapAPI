<?php

namespace App\Services;

use App\Models\Monstro;
use Illuminate\Support\Facades\Auth;

class MonstroService
{
    public function store(array $data): Monstro|string
    {
        $user = Auth::user();

        if (!$user || $user->acesso !== 'dm') {
            return "Apenas DMs podem criar monstros.";
        }

        return Monstro::create($data);
    }

    public function update(Monstro $monstro, array $data): Monstro|string
    {
        $user = Auth::user();

        if (!$user || $user->acesso !== 'dm') {
            return "Apenas DMs podem editar monstros.";
        }

        $monstro->update($data);
        return $monstro;
    }

    public function delete(Monstro $monstro): string
    {
        $user = Auth::user();

        if (!$user || $user->acesso !== 'dm') {
            return "Apenas DMs podem excluir monstros.";
        }

        $monstro->delete();
        return "Monstro excluído com sucesso.";
    }
}
