<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuantidadesMinimasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quantidades_minimas', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('material_id')->unsigned();
            $table->integer('planta_id')->unsigned();
            $table->integer('quantidade_minima');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('material_id')->references('id')->on('materiais');
            $table->foreign('planta_id')->references('id')->on('plantas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quantidades_minimas');
    }
}
