<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = "produtos";

    protected $fillable = [
        "nome",
        "estoque",
        "preco"
    ];

    public function setPrecoAttribute($value)
    {
        $this->attributes['preco'] = str_replace(",", ".", $value);
    }

    public function turmas()
    {
        return $this->belongsToMany(Turma::class, 'turmas_materiais', 'produto_id', 'turma_id');
    }
}
