<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//Modelo 'mensajeria'
use App\Models\mensajeria;

class MensajeriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creacion de Mensajerias ficticias
        for($i=0;$i<10;$i++){
            mensajeria::create([
                'nombre' => 'Paqueteria ' . $i + 1,
                'atencionCliente' => '834166728' . $i
            ]);
        }
    }
}
