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
            $table->string('potencia')->nullable();
            $table->string('tensao')->nullable();
            $table->integer('tipo_material_id')->unsigned()->nullable();
            $table->integer('reator_id')->unsigned()->nullable();
            $table->integer('receptaculo_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('tipo_material_id')->references('id')->on('tipos_materiais');
            $table->foreign('reator_id')->references('id')->on('materiais');
            $table->foreign('receptaculo_id')->references('id')->on('materiais');
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
