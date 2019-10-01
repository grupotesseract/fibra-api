<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiberacoesDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liberacoes_documentos', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('programacao_id')->unsigned();
            $table->timestamp('data_hora');
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
        Schema::drop('liberacoes_documentos');
    }
}
