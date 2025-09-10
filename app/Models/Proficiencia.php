<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proficiencia extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'lv_maximo'];

    public function bonus()
    {
        return $this->morphMany(Bonus::class, 'model');
    }
}
