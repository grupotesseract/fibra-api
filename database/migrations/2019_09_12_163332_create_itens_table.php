<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('nome');
            $table->string('qrcode');
            $table->enum('circuito', ['Normal', 'Emergência']);
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
        Schema::drop('itens');
    }
}
