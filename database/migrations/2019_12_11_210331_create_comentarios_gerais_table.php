<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComentariosGeraisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios_gerais', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('programacao_id')->unsigned();
            $table->text('comentario');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('programacao_id')->references('id')->on('programacoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comentarios_gerais');
    }
}
