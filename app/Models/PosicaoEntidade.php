<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosicaoEntidade extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_entidade',
        'entidade_id',
        'mapa_id',
        'quarto_id',
        'x',
        'y',
    ];

    public function mapa()
    {
        return $this->belongsTo(Mapa::class);
    }

    public function quarto()
    {
        return $this->belongsTo(Quarto::class);
    }
}
