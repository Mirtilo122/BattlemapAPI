<?php

namespace App\Services;

use App\Models\TipoItem;
use App\Models\Subtipo;

class TipoSubtipoService
{
    // Tipos
    public function listarTipos()
    {
        return TipoItem::with('subtipos')->paginate(15);
    }

    public function criarTipo(array $data): TipoItem
    {
        return TipoItem::create($data);
    }

    public function atualizarTipo(int $id, array $data): TipoItem
    {
        $tipo = TipoItem::findOrFail($id);
        $tipo->update($data);
        return $tipo;
    }

    public function deletarTipo(int $id): bool
    {
        $tipo = TipoItem::findOrFail($id);
        return $tipo->delete();
    }

    // Subtipos
    public function listarSubtipos()
    {
        return Subtipo::with('tipoItem')->paginate(15);
    }

    public function criarSubtipo(array $data): Subtipo
    {
        return Subtipo::create($data);
    }

    public function atualizarSubtipo(int $id, array $data): Subtipo
    {
        $subtipo = Subtipo::findOrFail($id);
        $subtipo->update($data);
        return $subtipo;
    }

    public function deletarSubtipo(int $id): bool
    {
        $subtipo = Subtipo::findOrFail($id);
        return $subtipo->delete();
    }
}
