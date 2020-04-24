<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItensAlteradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_alterados', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('programacao_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('material_id')->unsigned();
            $table->integer('quantidade_instalada');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('programacao_id')->references('id')->on('programacoes');
            $table->foreign('item_id')->references('id')->on('itens');
            $table->foreign('material_id')->references('id')->on('materiais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('itens_alterados');
    }
}
