<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
// use Database\Seeders\OrderStatusSeeder;
// use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\envio;

class CrearEnvioTest extends TestCase
{
    //Usamos el trait para crear las tablas en nuestro entorno de pruebas
    use RefreshDatabase;
    
    /** @test */
    public function a_post_can_be_created()
    {
        //Instalamos las seeders
        $this->seed();

        //Creamos la respuesta de nuestro metodo POST
        $response = $this->post('/api/envio', [
            'cpOrigen' => "97027",
            'cpDestino' => "99000",
            'peso' => 10,
            'largo' => 100,
            'alto' => 20,
            'ancho' => 25,
            'id_usuario' => 1,
            'id_mensajeria' => 1
        ]);

        //Esperamos una respuesta 201
        $response->assertStatus(201);
        //Validamos si la respuesta tiene un total de 6 valores
        $response->assertJsonCount(6);
        //Contamos si tenemos los 2 registros creados, de nuestra seeder y del test
        $this->assertCount(2, envio::all());
        //Obtenemos el registro insertado
        $envioRegistro = envio::where('id', '=', $response['id'])->first();
        //Validamos si los valores obtenidos son iguales a los enviados
        $this->assertEquals($envioRegistro->cpOrigen, '97027');
        $this->assertEquals($envioRegistro->cpDestino, '99000');
        $this->assertEquals($envioRegistro->id_usuario, 1);
        $this->assertEquals($envioRegistro->id_mensajeria, 1);
    }
}
