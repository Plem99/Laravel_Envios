<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnviosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cpOrigen', 5);
            $table->string('cpDestino', 5);
            $table->integer('peso');
            $table->integer('largo');
            $table->integer('alto');
            $table->integer('ancho');
            $table->double('tarifa', 10, 2);
            $table->bigInteger('id_usuario')->unsigned();
            $table->integer('id_mensajeria')->unsigned();
            //Llaves foráneas de la tabla 'users' y 'mensajerias'
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_mensajeria')->references('id')->on('mensajerias')->onDelete('cascade');
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
        Schema::dropIfExists('envios');
    }
}
