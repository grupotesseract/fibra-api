<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateManutencoesCivilEletricaTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manutencoes_civil_eletrica', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->text('problemas_encontrados');
            $table->text('informacoes_adicionais');
            $table->text('observacoes');
            $table->string('obra_atividade');
            $table->string('equipe_cliente');
            $table->timestamp('data_hora_entrada');
            $table->timestamp('data_hora_saida');
            $table->timestamp('data_hora_inicio_lem')->nullable();
            $table->timestamp('data_hora_final_lem')->nullable();
            $table->timestamp('data_hora_inicio_let')->nullable();
            $table->timestamp('data_hora_final_let')->nullable();
            $table->timestamp('data_hora_inicio_atividades');
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
        Schema::drop('manutencoes_civil_eletrica');
    }
}
