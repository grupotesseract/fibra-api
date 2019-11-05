<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTiposMateriaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_materiais', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('nome');
            $table->string('abreviacao');
            $table->enum('tipo', ['Lâmpada', 'Reator']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tipos_materiais');
    }
}
