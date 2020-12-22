<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $table = "alunos";

    protected $fillable = [
        'nome',
        'data_nascimento',
        'cep',
        'endereco',
        'bairro',
        'cidade',
        'uf'
    ];

    public function vendas()
    {
        return $this->hasMany(Venda::class, "aluno_id", "id");
    }

    public function turmas()
    {
        return $this->belongsTo(Turma::class, "turma_id", "id");
    }
}
