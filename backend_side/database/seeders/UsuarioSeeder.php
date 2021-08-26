<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//Modelo 'User'
use App\Models\User;
//Utilizamos la clase 'Hash' para encriptar a los usuarios
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
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
            User::create([
                'name' => 'Usuario ' . $i + 1,
                'email' => 'correo' . $i . '@gmail.com',
                'password' => Hash::make('correo'.$i.'@gmail.com')
            ]);
        }
    }
}
