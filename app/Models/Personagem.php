<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personagem extends Model
{
    use HasFactory;
    protected $table = 'personagens';
    protected $fillable = [
        'nome',
        'descricao',
        'imagem_perfil',
        'imagem_token',
        'deslocamento',
        'owner_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
