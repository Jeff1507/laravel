<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'imagem',
        'estoque',
        'valor_unitario',
        'descricao',
        'categoria_id',
        'unidade_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function unidadeMedida()
    {
        return $this->belongsTo(Unidade::class);
    }
}
