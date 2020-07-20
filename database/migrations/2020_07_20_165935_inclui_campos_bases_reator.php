<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IncluiCamposBasesReator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('itens_alterados', function (Blueprint $table) {
            $table->integer('quantidade_base')->nullable();
            $table->integer('quantidade_reator')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('itens_alterados', function (Blueprint $table) {
            $table->dropColumn('quantidade_base');
            $table->dropColumn('quantidade_reator');
        });
    }
}
