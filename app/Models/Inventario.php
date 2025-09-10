<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'personagem_id',
        'quantidade',
        'local_id',
        'caminho',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function personagem()
    {
        return $this->belongsTo(Personagem::class, 'personagem_id');
    }

    public function local()
    {
        return $this->belongsTo(LocalJogador::class, 'local_id');
    }
}
