<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConsultarRastreoTest extends TestCase
{
    //Usamos el trait para crear las tablas en nuestro entorno de pruebas
    use RefreshDatabase;

    /** @test */
    public function a_record_can_be_retrieved()
    {
        //Instalamos las seeders
        $this->seed();
        //Asignamos un codigo de rastreo creado con una seeder
        $codigoRastreo = '2700099000Paqa112345';
        $response = $this->get('/api/rastreo/'. $codigoRastreo);
        $response->assertStatus(200);
    }
}
