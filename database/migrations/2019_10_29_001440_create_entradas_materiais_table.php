<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntradasMateriaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas_materiais', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('material_id')->unsigned();
            $table->integer('programacao_id')->unsigned();
            $table->integer('quantidade');
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
        Schema::drop('entradas_materiais');
    }
}
