<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaPivoItensMateriais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_materiais', function (Blueprint $table) {
            $table->bigInteger('id', true);

            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('itens');

            $table->integer('material_id')->unsigned();
            $table->foreign('material_id')->references('id')->on('materiais');

            $table->integer('quantidade_instalada')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('itens_materiais');
    }
}
