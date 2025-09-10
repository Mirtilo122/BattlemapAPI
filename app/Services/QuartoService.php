<?php

namespace App\Services;

use App\Models\Quarto;
use App\Models\Porta;
use Illuminate\Support\Facades\Auth;

class QuartoService
{
    /**
     * Lista todos os quartos de um mapa
     */
    public function listarQuartosPorMapa(int $mapaId)
    {
        return Quarto::where('mapa_id', $mapaId)->get();
    }

    /**
     * Cria um novo quarto
     */
    public function criarQuarto(array $dados)
    {
        $this->verificarDM();

        $dados['inicial'] = isset($dados['inicial']) ? 1 : 0;

        return Quarto::create($dados);
    }

    /**
     * Atualiza um quarto
     */
    public function atualizarQuarto(Quarto $quarto, array $dados)
    {
        $this->verificarDM();

        $dados['inicial'] = isset($dados['inicial']) ? 1 : 0;;

        return $quarto->update($dados);
    }

    /**
     * Deleta um quarto e suas portas associadas
     */
    public function deletarQuarto(Quarto $quarto)
    {
        $this->verificarDM();

        // Deleta portas associadas
        Porta::where('qa_id', $quarto->id)->orWhere('qb_id', $quarto->id)->delete();

        return $quarto->delete();
    }

    /**
     * Lista portas de um quarto (onde o quarto é A ou B)
     */
    public function listarPortas(Quarto $quarto)
    {
        return Porta::where('qa_id', $quarto->id)
            ->orWhere('qb_id', $quarto->id)
            ->get();
    }

    /**
     * Cria uma porta
     */
    public function criarPorta(array $dados)
    {
        $this->verificarDM();

        return Porta::create($dados);
    }

    /**
     * Atualiza uma porta
     */
    public function atualizarPorta(Porta $porta, array $dados)
    {
        $this->verificarDM();

        return $porta->update($dados);
    }

    /**
     * Deleta uma porta
     */
    public function deletarPorta(Porta $porta)
    {
        $this->verificarDM();

        return $porta->delete();
    }

    /**
     * Verifica se o usuário é DM
     */
    private function verificarDM()
    {
        $user = Auth::user();
        if (!$user || $user->acesso !== 'dm') {
            abort(403, 'Acesso negado: apenas DM pode realizar esta ação.');
        }
    }
}
