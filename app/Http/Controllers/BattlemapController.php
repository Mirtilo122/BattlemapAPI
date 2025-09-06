<?php

namespace App\Http\Controllers;

use App\Models\PosicaoEntidade;
use App\Models\Porta;
use App\Services\BattlemapService;
use Illuminate\Http\Request;

use App\Models\Personagem;
use Illuminate\Support\Facades\Auth;
use App\Models\Monstro;

class BattlemapController extends Controller
{
    protected $service;

    public function __construct(BattlemapService $service)
    {
        $this->service = $service;
    }

    public function index($mapaId, $quartoId = null)
    {
        $user = Auth::user();

        if (!$user) {
            return "Usuário não autenticado.";
        }


        $personagens  = Personagem::with('owner')->get();

        $monstros = Monstro::all();

        if ($user->acesso === 'jogador') {

            $monstros = [];
        }

        if (!$quartoId) {
            $quartoInicial = \App\Models\Quarto::where('mapa_id', $mapaId)
                ->where('inicial', true)
                ->first();

            $quartoId = $quartoInicial ? $quartoInicial->id : null;
        }

        $mapa = $this->service->obterMapa($mapaId, $quartoId);



        return view('battlemap.index', compact('mapa', 'mapaId', 'quartoId', 'personagens', 'monstros'));
    }

    public function mover(Request $request, $entidade)
    {
        $posicao = PosicaoEntidade::updateOrCreate(
            ['entidade_id' => $entidade],
            [
                'tipo_entidade' => $request->tipo_entidade,
                'mapa_id' => $request->mapa_id,
                'quarto_id' => $request->quarto_id,
                'x' => $request->x,
                'y' => $request->y,
            ]
        );

        return response()->json(['success' => true, 'posicao' => $posicao]);
    }

    public function trancarPorta(Request $request, Porta $porta)
    {
        $dados = $request->validate([
            'trancada' => 'required|boolean',
        ]);

        $estado = $this->service->atualizarEstadoPorta($porta, $dados['trancada']);
        return response()->json(['success' => true, 'estado' => $estado->trancada]);
    }
}
