<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'itens';

    use HasFactory;

    protected $fillable = [
        'nome', 'descricao', 'habilidade', 'imagem',
        'tipo_item_id', 'subtipo_id',
        'originalidade', 'guia',
        'raridade', 'categoria', 'elemento', 'espaco', 'valor'
    ];

    public function tipo()
    {
        return $this->belongsTo(TipoItem::class, 'tipo_item_id');
    }

    public function subtipo()
    {
        return $this->belongsTo(Subtipo::class, 'subtipo_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'item_tag');
    }

    public function modificacoes()
    {
        return $this->belongsToMany(Modificacao::class, 'item_modificacao');
    }

    public function arma()
    {
        return $this->hasOne(ItemArma::class);
    }

    public function personagens()
    {
        return $this->belongsToMany(Personagem::class, 'item_personagem', 'item_id', 'personagem_id')
                    ->withTimestamps();
    }
}
