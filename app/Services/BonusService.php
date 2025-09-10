<?php

namespace App\Services;

use App\Models\Pericia;
use App\Models\Proficiencia;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BonusService
{

    public function listarPericias()
    {
        return Pericia::all();
    }

    public function criarPericia(array $data): Pericia
    {
        return Pericia::create($data);
    }

    public function atualizarPericia(int $id, array $data): Pericia
    {
        $pericia = Pericia::findOrFail($id);
        $pericia->update($data);
        return $pericia;
    }

    public function deletarPericia(int $id): bool
    {
        $pericia = Pericia::findOrFail($id);
        return $pericia->delete();
    }


    public function listarProficiencias()
    {
        return Proficiencia::all();
    }

    public function criarProficiencia(array $data): Proficiencia
    {
        return Proficiencia::create($data);
    }

    public function atualizarProficiencia(int $id, array $data): Proficiencia
    {
        $proficiencia = Proficiencia::findOrFail($id);
        $proficiencia->update($data);
        return $proficiencia;
    }

    public function deletarProficiencia(int $id): bool
    {
        $proficiencia = Proficiencia::findOrFail($id);
        return $proficiencia->delete();
    }
}
