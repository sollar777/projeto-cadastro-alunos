<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAlunos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("nome");
            $table->date("data_nascimento");
            $table->unsignedBigInteger("turma_id");
            $table->integer("cep");
            $table->string("endereco");
            $table->string("bairro");
            $table->string("cidade");
            $table->string("uf");

            $table->foreign("turma_id")->references("id")->on("turmas");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }
}
