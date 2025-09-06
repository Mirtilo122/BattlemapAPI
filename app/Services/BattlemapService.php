<?php

namespace App\Services;

use App\Models\PosicaoEntidade;
use App\Models\EstadoPorta;
use App\Models\Porta;

class BattlemapService
{
    public function obterMapa($mapaId, $quartoId = null)
    {
        $posicoes = PosicaoEntidade::where('mapa_id', $mapaId)
            ->when($quartoId, fn($q) => $q->where('quarto_id', $quartoId))
            ->get();

        $portas = Porta::where('mapa_id', $mapaId)
            ->when($quartoId, fn($q) => $q->where(function($query) use ($quartoId) {
                $query->where('qa_id', $quartoId)
                    ->orWhere('qb_id', $quartoId);
            }))
            ->get()
            ->map(function($porta){
                $porta->estado = $porta->estadoPorta()->first();
                return $porta;
            });

        return ['posicoes' => $posicoes, 'portas' => $portas];
    }


    public function moverEntidade(PosicaoEntidade $entidade, $x, $y, $quartoId = null)
    {
        $entidade->update([
            'x' => $x,
            'y' => $y,
            'quarto_id' => $quartoId,
        ]);
        return $entidade;
    }

    public function atualizarEstadoPorta(Porta $porta, bool $trancada)
    {
        return EstadoPorta::updateOrCreate(
            ['porta_id' => $porta->id],
            ['trancada' => $trancada]
        );
    }
}
