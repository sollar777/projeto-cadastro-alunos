<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurmasMateriaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas_materiais', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("turma_id");
            $table->unsignedBigInteger("produto_id");

            $table->foreign("turma_id")->references("id")->on("turmas");
            $table->foreign("produto_id")->references("id")->on("produtos");

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
        Schema::dropIfExists('turmas_materiais');
    }
}
