<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemArma extends Model
{
    protected $table = 'itens_armas';

    use HasFactory;

    protected $fillable = [
        'item_id', 'dano_base', 'margem_critico_base',
        'multiplicador_critico_base', 'arma_base', 'municao'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function municoes()
    {
        return $this->hasMany(ArmaMunicao::class, 'arma_id');
    }
}
