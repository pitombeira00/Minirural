<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarLancamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('classificacao', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao');
            $table->string('tipo');
            $table->integer('excluido');
            $table->timestamps();
        });
        

        Schema::create('lancamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('Data_pagamento');
            $table->float('valor');
            $table->unsignedInteger('id_plano');
            $table->unsignedInteger('id_class');
            $table->foreign('id_plano')->references('id')->on('plano');
            $table->foreign('id_class')->references('id')->on('classificacao');
            $table->integer('excluido');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lancamentos');
    }
}
