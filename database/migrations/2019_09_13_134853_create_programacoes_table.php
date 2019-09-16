<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programacoes', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->timestamp('data_inicio_prevista');
            $table->timestamp('data_fim_prevista');
            $table->timestamp('data_inicio_real')->nullable();
            $table->timestamp('data_fim_real')->nullable();
            $table->integer('planta_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('planta_id')->references('id')->on('plantas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('programacoes');
    }
}
