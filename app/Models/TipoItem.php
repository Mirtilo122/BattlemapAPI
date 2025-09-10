<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoItem extends Model
{
    use HasFactory;
    protected $table = 'tipos_itens';

    protected $fillable = ['nome', 'descricao'];

    public function subtipos()
    {
        return $this->hasMany(Subtipo::class);
    }
}
