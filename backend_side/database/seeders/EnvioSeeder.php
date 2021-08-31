<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//Modelo de 'envio' y 'rastreo'
use App\Models\envio;
use App\Models\rastreo;

class EnvioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ///Creamos un envio
        $registroEnvio = envio::create([
            'cpOrigen' => "27000",
            'cpDestino' => "99000",
            'peso' => 10,
            'largo' => 100,
            'alto' => 20,
            'ancho' => 25,
            'tarifa' => 250.60,
            'id_usuario' => 1,
            'id_mensajeria' => 1
        ]); 
        //Registramos una orden de rastreo
        rastreo::create([
            'codigo' => '2700099000Paqa112345',
            'estado' => 'En espera',
            'id_envio' => $registroEnvio->id
        ]);
    }
}
