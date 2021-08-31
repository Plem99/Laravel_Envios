<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Ejecutamos la creacion de registros en nuestros factories
        \App\Models\User::factory(10)->create();
        \App\Models\mensajeria::factory(10)->create();
        //Llamamos los seeders creados
        $this->call(EnvioSeeder::class);
    }
}
