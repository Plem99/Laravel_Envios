<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//Modelo de ''user 'mensajeria', 'envio' y 'rastreo'
use App\Models\User;
use App\Models\mensajeria;
use App\Models\envio;
use App\Models\rastreo;
//Utilizamos la clase 'Hash' para encriptar a los usuarios
use Illuminate\Support\Facades\Hash;

class EnvioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creamos un Usuario
        $registroUsuario = User::create([
            'name' => 'Usuario 1',
            'email' => 'correo0@gmail.com',
            'password' => Hash::make('correo0@gmail.com')
        ]);
        //Creamos una mensajeria
        $registroMensajeria = mensajeria::create([
            'nombre' => "Paqueteria 1",
            'atencionCliente' => "8341667284"
        ]);
        ///Creamos un envio
        $registroEnvio = envio::create([
            'cpOrigen' => "27000",
            'cpDestino' => "99000",
            'peso' => 10,
            'largo' => 100,
            'alto' => 20,
            'ancho' => 25,
            'tarifa' => 250.60,
            'id_usuario' => $registroUsuario->id,
            'id_mensajeria' => $registroMensajeria->id
        ]); 
        //Registramos una orden de rastreo
        rastreo::create([
            'codigo' => '2700099000Paqa112345',
            'estado' => 'En espera',
            'id_envio' => $registroEnvio->id
        ]);
    }
}
