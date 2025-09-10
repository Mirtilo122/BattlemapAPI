<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalJogador extends Model
{
    protected $table = 'locais_jogadores';

    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'personagem_id',
        'compartilhado',
    ];

    public function personagem()
    {
        return $this->belongsTo(Personagem::class, 'personagem_id');
    }

    public function inventarios()
    {
        return $this->hasMany(Inventario::class, 'local_id');
    }
}
