<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlantasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantas', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('nome');
            $table->string('endereco');
            $table->integer('cidade_id')->unsigned();
            $table->integer('empresa_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->foreign('empresa_id')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('plantas');
    }
}
