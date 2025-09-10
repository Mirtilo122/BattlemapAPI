<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pericia extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'atributo_base'];

    public function bonus()
    {
        return $this->morphMany(Bonus::class, 'model');
    }
}
