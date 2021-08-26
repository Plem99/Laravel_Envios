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
            $table->double('peso', 4, 2);
            $table->double('largo', 5, 2);
            $table->double('alto', 5, 2);
            $table->double('ancho', 5, 2);
            $table->double('tarifa', 10, 2);
            $table->bigInteger('id_usuario')->unsigned();
            $table->integer('id_mensajeria')->unsigned();
            //Llave foránea de la tabla 'mensajerias'
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
