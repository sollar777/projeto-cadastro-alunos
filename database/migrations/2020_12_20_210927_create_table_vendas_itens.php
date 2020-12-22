<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableVendasItens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas_itens', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("venda_id");
            $table->unsignedBigInteger("produto_id");
            $table->decimal("preco", 10, 2);
            $table->double("quantidade");

            $table->foreign("venda_id")->references("id")->on("vendas");
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
        Schema::dropIfExists('vendas_itens');
    }
}
