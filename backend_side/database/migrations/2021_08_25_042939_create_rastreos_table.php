<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRastreosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rastreos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 20);
            $table->enum('estado',['En espera', 'Enviado', 'En camino', 'Entregado']);
            $table->integer('id_envio')->unsigned();
            //Llave foránea de la tabla 'envios'
            $table->foreign('id_envio')->references('id')->on('envios')->onDelete('cascade');
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
        Schema::dropIfExists('rastreos');
    }
}
