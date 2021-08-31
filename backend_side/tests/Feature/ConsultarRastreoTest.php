<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
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
        //Se consulta la orden de rastreo dado el codigo
        $response = $this->get('/api/rastreo/'. $codigoRastreo);
        //Validamos si se realizo la consulta con exito con la respuesta 200
        $response->assertStatus(200);
        //Validamos si la respuesta tiene un total de 3 valores
        $response->assertJsonCount(3);
    }
}
