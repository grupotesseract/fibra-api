<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiais', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('nome')->nullable();
            $table->integer('tipo_material_id')->unsigned()->nullable();
            $table->integer('potencia_id')->unsigned()->nullable();
            $table->integer('tensao_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('tipo_material_id')->references('id')->on('tipos_materiais');
            $table->foreign('potencia_id')->references('id')->on('potencias');
            $table->foreign('tensao_id')->references('id')->on('tensoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('materiais');
    }
}
