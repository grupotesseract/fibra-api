<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstoqueTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoque', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('material_id')->unsigned();
            $table->integer('programacao_id')->unsigned();
            $table->integer('quantidade_inicial');
            $table->integer('quantidade_final')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('material_id')->references('id')->on('materiais');
            $table->foreign('programacao_id')->references('id')->on('programacoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('estoque');
    }
}
