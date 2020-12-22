<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $table = "vendas";

    protected $fillable = [
        "aluno_id",
        "data",
        "finalizada"
    ];

    public function aluno(){
        return $this->belongsTo(Aluno::class, "aluno_id", "id");
    }

    public function vendasEfetuadas()
    {
        return $this->hasMany(Venda_Item::class, "venda_id", "id");
    }
}
