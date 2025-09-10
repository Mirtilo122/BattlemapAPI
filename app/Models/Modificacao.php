<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modificacao extends Model
{
    protected $table = 'modificacoes';

    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'habilidade', 'tipo', 'tipos'];

    protected $casts = [
        'tipos' => 'array',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'modificacao_tag');
    }

    public function itens()
    {
        return $this->belongsToMany(Item::class, 'item_modificacao');
    }
}
