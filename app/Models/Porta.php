<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Porta extends Model
{
    use HasFactory;

    protected $table = 'portas';

    protected $fillable = [
        'qa_id', 'qb_id', 'qax', 'qay', 'qbx', 'qby', 'mapa_id'
    ];

    public function mapa()
    {
        return $this->belongsTo(Mapa::class);
    }

    public function quartoA()
    {
        return $this->belongsTo(Quarto::class, 'qa_id');
    }

    public function quartoB()
    {
        return $this->belongsTo(Quarto::class, 'qb_id');
    }

    public function estadoPorta()
    {
        return $this->hasOne(EstadoPorta::class, 'porta_id');
    }
}
