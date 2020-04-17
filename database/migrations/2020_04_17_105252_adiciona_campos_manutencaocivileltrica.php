<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdicionaCamposManutencaocivileltrica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manutencoes_civil_eletrica', function (Blueprint $table) {
            $table->text('it')->nullable();
            $table->text('lem')->nullable();
            $table->text('let')->nullable();
            $table->text('os')->nullable();
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
            $table->dropColumn('it');
            $table->dropColumn('lem');
            $table->dropColumn('let');
            $table->dropColumn('os');
        });
    }
}
