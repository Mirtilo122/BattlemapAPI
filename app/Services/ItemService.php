<?php

namespace App\Services;

use App\Models\Item;
use App\Models\ItemArma;
use App\Models\ArmaMunicao;
use Illuminate\Support\Facades\DB;
use App\Models\Personagem;
use Illuminate\Support\Collection;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class ItemService
{
    /**
     * Lista todos os itens, podendo aplicar filtros no futuro
     */
    public function listar()
    {
        return Item::where('guia', true)
            ->with(['tipo', 'subtipo', 'tags', 'modificacoes', 'arma', 'personagens'])
            ->get();
    }

    /**
     * Busca um item específico com suas relações
     */
    public function buscar(int $id): Item
    {
        return Item::with(['tipo', 'subtipo', 'tags', 'modificacoes', 'arma.municoes', 'personagens'])
            ->findOrFail($id);
    }

    /**
     * Cria um novo item
     */
    public function criar(array $data): Item
    {
        return DB::transaction(function () use ($data) {

            $data['imagem'] = null;
            $data['imagem'] = $data['imagem_link'] ?? null;

            // Cria item base
            $item = Item::create($data);

            // Relaciona tags (se existirem)
            if (!empty($data['tags'])) {
                $item->tags()->sync($data['tags']);
            }

            // Relaciona modificações (se existirem)
            if (!empty($data['modificacoes'])) {
                $item->modificacoes()->sync($data['modificacoes']);
            }

            // Se for arma, cria o registro em itens_armas
            if (!empty($data['arma'])) {
                $armaData = $data['arma'];
                $armaData['item_id'] = $item->id;

                $itemArma = ItemArma::create($armaData);

                // Se a arma usar munição e vier munições no payload
                if (!empty($armaData['municao']) && !empty($armaData['municoes'])) {
                    foreach ($armaData['municoes'] as $municao) {
                        ArmaMunicao::create([
                            'arma_id'    => $itemArma->id,
                            'municao_id' => $municao['municao_id'],
                            'atual'      => $municao['atual'] ?? 0,
                            'maximo'     => $municao['maximo'] ?? 0,
                        ]);
                    }
                }
            }

            return $item->fresh(['tags', 'modificacoes', 'arma.municoes']);
        });
    }

    /**
     * Atualiza um item
     */
    public function atualizar(int $id, array $data): Item
    {
        return DB::transaction(function () use ($id, $data) {
            $item = Item::findOrFail($id);

            // Tratar imagem como link
            $data['imagem'] = null; // Limpamos o campo upload antigo
            $data['imagem'] = $data['imagem_link'] ?? null;

            // Atualiza dados do item
            $item->update($data);

            // Atualiza tags
            if (isset($data['tags'])) {
                $item->tags()->sync($data['tags']);
            }

            // Atualiza modificações
            if (isset($data['modificacoes'])) {
                $item->modificacoes()->sync($data['modificacoes']);
            }

            // Atualiza/Cria arma
            if (!empty($data['arma'])) {
                $armaData = $data['arma'];
                $itemArma = $item->arma()->updateOrCreate(
                    ['item_id' => $item->id],
                    $armaData
                );

                // Atualiza munições
                if (!empty($armaData['municao'])) {
                    $itemArma->municoes()->delete(); // limpa as antigas
                    if (!empty($armaData['municoes'])) {
                        foreach ($armaData['municoes'] as $municao) {
                            ArmaMunicao::create([
                                'arma_id'    => $itemArma->id,
                                'municao_id' => $municao['municao_id'],
                                'atual'      => $municao['atual'] ?? 0,
                                'maximo'     => $municao['maximo'] ?? 0,
                            ]);
                        }
                    }
                }
            }

            return $item->fresh(['tags', 'modificacoes', 'arma.municoes']);
        });
    }

    /**
     * Deleta um item (e armas/munições associadas)
     */
    public function deletar(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            $item = Item::findOrFail($id);

            // Remove relações
            $item->tags()->detach();
            $item->modificacoes()->detach();
            $item->personagens()->detach();

            // Remove arma e munições (se for arma)
            if ($item->arma) {
                $item->arma->municoes()->delete();
                $item->arma->delete();
            }

            return $item->delete();
        });
    }

    /**
     * Marca quem é dono de um item único
     */
    public function atribuirDono(int $itemId, int $personagemId): void
    {
        $item = Item::findOrFail($itemId);

        if ($item->originalidade !== 'unico') {
            throw new Exception("Somente itens únicos podem ter dono.");
        }

        $item->personagens()->syncWithoutDetaching([$personagemId]);
    }

    /**
     * Remove dono de um item único
     */
    public function removerDono(int $itemId, int $personagemId): void
    {
        $item = Item::findOrFail($itemId);

        if ($item->originalidade !== 'unico') {
            throw new Exception("Somente itens únicos podem ter dono.");
        }

        $item->personagens()->detach($personagemId);
    }


    /**
     * Gasta 1 de munição de um item.
     */
    public function gastarMunicao(Item $item): Item
    {
        if (!$item->arma || $item->arma->municao_atual <= 0) {
            throw new Exception("A arma precisa ser recarregada.");
        }

        $item->arma->municao_atual -= 1;
        $item->arma->save();

        return $item;
    }

    /**
     * Recarrega uma arma até o limite da munição máxima,
     * consumindo munição do inventário do personagem.
     */
    public function carregarArma(Item $arma, Personagem $personagem, Item $municaoItem): Item
    {
        if (!$arma->arma) {
            throw new Exception("Esse item não é uma arma.");
        }

        $municaoAtual = $arma->arma->municao_atual;
        $municaoMaxima = $arma->arma->municao_maxima;

        $espaco = $municaoMaxima - $municaoAtual;

        if ($espaco <= 0) {
            throw new Exception("A arma já está totalmente carregada.");
        }

        $municaoDisponivel = $municaoItem->quantidade;

        $quantidadeCarregada = min($espaco, $municaoDisponivel);

        // Atualiza arma
        $arma->arma->municao_atual += $quantidadeCarregada;
        $arma->arma->save();

        // Atualiza item de munição
        $municaoItem->quantidade -= $quantidadeCarregada;
        $municaoItem->save();

        return $arma;
    }

    /**
     * Lista itens separados por tipo.
     */
    public function listarPorTipoComFiltros(array $filtros = []): Collection
    {
        $query = Item::where('guia', true)
            ->with(['tipo', 'subtipo', 'tags', 'modificacoes', 'arma', 'personagens']);

        if (!empty($filtros['search'])) {
            $query->where(function ($q) use ($filtros) {
                $q->where('nome', 'like', '%' . $filtros['search'] . '%')
                ->orWhere('descricao', 'like', '%' . $filtros['search'] . '%');
            });
        }

        if (!empty($filtros['subtipo'])) {
            $query->where('subtipo_id', $filtros['subtipo']);
        }

        if (!empty($filtros['categoria'])) {
            $query->where('categoria', $filtros['categoria']);
        }

        if (!empty($filtros['valor'])) {
            $query->where('valor', '<=', $filtros['valor']);
        }

        if (!empty($filtros['elemento']) && $filtros['elemento'] !== 'Todos') {
            $query->where('elemento', $filtros['elemento']);
        }

        if (!empty($filtros['tag'])) {
            $query->whereHas('tags', function ($q) use ($filtros) {
                $q->where('tag_id', $filtros['tag']);
            });
        }

        $itens = $query->get();

        return $itens->groupBy(fn($item) => $item->tipo->nome ?? 'Sem Tipo')
            ->map(function ($collection) {
                $page = request()->get('page', 1);
                $perPage = 12;

                $items = $collection->forPage($page, $perPage);

                return new LengthAwarePaginator(
                    $items,
                    $collection->count(),
                    $perPage,
                    $page,
                    ['path' => request()->url(), 'query' => request()->query()]
                );
            });
    }

    /**
     * Retorna um item com todos os relacionamentos.
     */
    public function show(int $id)
    {
        return Item::with(['tipo', 'subtipo', 'tags', 'modificacoes', 'arma', 'personagens'])
            ->findOrFail($id);
    }
}
