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
            $table->string('nome');
            $table->string('potencia')->nullable();
            $table->string('tensao')->nullable();
            $table->integer('tipo_material_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('tipo_material_id')->references('id')->on('tipos_materiais');
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
