<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda_Item extends Model
{
    use HasFactory;

    protected $table = "vendas_itens";

    protected $fillable = [
        'venda_id',
        'produto_id',
        'preco',
        'quantidade'
    ];

    public function venda()
    {
        return $this->belongsTo(Venda::class, "venda_id", "id");
    }
}
