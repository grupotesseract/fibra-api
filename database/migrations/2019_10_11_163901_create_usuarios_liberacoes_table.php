<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuariosLiberacoesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_liberacoes', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('liberacao_documento_id')->unsigned();
            $table->integer('usuario_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('liberacao_documento_id')->references('id')->on('liberacoes_documentos');
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
        Schema::drop('usuarios_liberacoes');
    }
}
