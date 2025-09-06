<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPorta extends Model
{
    use HasFactory;

    protected $fillable = [
        'porta_id',
        'trancada',
    ];

    public function porta()
    {
        return $this->belongsTo(Porta::class);
    }

    
}

