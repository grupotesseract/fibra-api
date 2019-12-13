<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionaColunasQtdesubst extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quantidades_substituidas', function (Blueprint $table) {
            $table->integer('base_id')->unsigned()->nullable();
            $table->foreign('base_id')->references('id')->on('materiais');
            $table->integer('reator_id')->unsigned()->nullable();
            $table->foreign('reator_id')->references('id')->on('materiais');

            $table->integer('quantidade_substituida_reator')->nullable();
            $table->integer('quantidade_substituida_base')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quantidades_substituidas', function (Blueprint $table) {
            $table->dropColumn('reator_id');
            $table->dropColumn('base_id');
            $table->dropColumn('quantidade_substituida_reator');
            $table->dropColumn('quantidade_substituida_base');
        });
    }
}
