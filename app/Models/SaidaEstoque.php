<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaidaEstoque extends Model
{
    use HasFactory;

    protected $table = 'saida_estoques';

    protected $fillable = [
        'cliente_id',
        'produto_id',
        'quantidade',
        'valor_total',
        'data_retirada',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
