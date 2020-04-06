<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAtividadesRealizadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividades_realizadas', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('texto');
            $table->boolean('status');
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
        Schema::drop('atividades_realizadas');
    }
}
