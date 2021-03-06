<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColunaDatamanutencao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quantidades_substituidas', function (Blueprint $table) {
            $table->dropColumn('data_manutencao');
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
            $table->timestamp('data_manutencao')->nullable();
        });
    }
}
