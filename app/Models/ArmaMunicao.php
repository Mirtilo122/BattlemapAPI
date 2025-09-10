<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArmaMunicao extends Model
{
    use HasFactory;

    protected $table = 'arma_municao';

    protected $fillable = [
        'arma_id',
        'municao_id',
        'atual',
        'maximo',
    ];

    public function arma()
    {
        return $this->belongsTo(ItemArma::class, 'arma_id');
    }

    public function municao()
    {
        return $this->belongsTo(Item::class, 'municao_id');
    }
}
