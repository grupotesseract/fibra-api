<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cloudinary_id')->nullable();
            $table->string('path')->nullable();
            $table->integer('programacao_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('programacao_id')->references('id')->on('programacoes');
            $table->foreign('item_id')->references('id')->on('itens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fotos');
    }
}
