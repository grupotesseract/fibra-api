<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlteraTabelaQtdessubstituidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quantidades_substituidas', function (Blueprint $table) {
            $table->timestamp('data_manutencao');
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
            $table->dropColumn('data_manutencao');
        });
    }
}
