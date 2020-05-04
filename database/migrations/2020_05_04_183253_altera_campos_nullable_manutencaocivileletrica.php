<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlteraCamposNullableManutencaocivileletrica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manutencoes_civil_eletrica', function (Blueprint $table) {
            $table->text('problemas_encontrados')->nullable()->change();
            $table->text('informacoes_adicionais')->nullable()->change();
            $table->text('observacoes')->nullable()->change();
            $table->string('obra_atividade')->nullable()->change();
            $table->string('equipe_cliente')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manutencoes_civil_eletrica', function (Blueprint $table) {
            //
        });
    }
}
