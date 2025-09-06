<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monstro extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'deslocamento_base',
        'imagem_perfil',
        'imagem_token',
    ];
}
