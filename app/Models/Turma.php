<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $table = "turmas";

    protected $fillable = [
        "nome"  
    ];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'turmas_materiais', 'turma_id', 'produto_id');
    }

    public function alunos()
    {
        return $this->hasMany(Aluno::class, "turma_id", "id");
    }

}
