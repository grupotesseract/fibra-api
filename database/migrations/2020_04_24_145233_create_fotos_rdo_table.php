<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFotosRdoTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos_rdo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cloudinary_id')->nullable();
            $table->string('path')->nullable();
            $table->integer('manutencao_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('manutencao_id')->references('id')->on('manutencoes_civil_eletrica');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fotos_rdo');
    }
}
