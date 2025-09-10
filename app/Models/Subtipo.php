<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtipo extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'tipo_item_id'];

    public function tipoItem()
    {
        return $this->belongsTo(TipoItem::class);
    }
}
