<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuariosManutencoesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_manutencoes', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('manutencao_id')->unsigned();
            $table->integer('usuario_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('manutencao_id')->references('id')->on('manutencoes_civil_eletrica');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuarios_manutencoes');
    }
}
