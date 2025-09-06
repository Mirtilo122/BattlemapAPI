<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quarto extends Model
{
    use HasFactory;

    protected $table = 'quartos';

    protected $fillable = [
        'nome', 'x', 'y', 'inicial', 'mapa_id'
    ];

    public function mapa()
    {
        return $this->belongsTo(Mapa::class);
    }

    public function portasSaida()
    {
        return $this->hasMany(Porta::class, 'qa_id');
    }

    public function portasEntrada()
    {
        return $this->hasMany(Porta::class, 'qb_id');
    }
}
