<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma_Produto extends Model
{
    use HasFactory;

    protected $table = 'turmas_materiais';

    protected $fillable = ['turma_id', 'produto_id'];
}
