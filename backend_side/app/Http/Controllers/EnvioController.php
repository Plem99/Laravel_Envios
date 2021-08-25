<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Modelo de 'envio'
use App\Models\envio;
//Modelo de 'rastreo'
use App\Models\rastreo;
//Modelo de 'mensajeria'
use App\Models\mensajeria;

class EnvioController extends Controller
{
    /**
     * Crea un nuevo envio con los datos enviados.
     *
     * @return \Illuminate\Http\Request  $request
     */
    public function create(Request $request)
    {
        //Obtenemos el peso volumetrico
        $pesoVolumetrico = $this->pesoVolumetrico($request->largo, $request->alto, $request->ancho);
        //Calculamos la tarifa del envio redondeandola a 2 cifras significativas
        $tarifaEnvio = round($this->tarifaEnvio(intval($request->cpOrigen), intval($request->cpDestino), $request->peso, $pesoVolumetrico), 2);
        //Generamos el código de rastreo
        $codigoRastreo = $this->codigoRastreo($request);
        //Creamos nuestro registro en nuestra base de datos
        // $registroEnvio = envio::create([
        //     'cpOrigen' => $request->cpOrigen,
        //     'cpDestino' => $request->cpDestino,
        //     'peso' => $request->peso,
        //     'largo' => $request->largo,
        //     'alto' => $request->alto,
        //     'ancho' => $request->ancho,
        //     'tarifa' => $tarifaEnvio,
        //     'id_mensajeria' => $request->id_mensajeria
        // ]);
        //return response()->json(['Registro Hecho' => $registroEnvio], 201);
        //Retornamos la respuesta de nuestro registro de envío
        return response()->json(['Registro Hecho' => $codigoRastreo], 201);
    }

    /**
     * Calcular el Peso volumétrico.
     * Se trata del cálculo que tiene como resultado la densidad de un paquete.
     * Fórmula para el peso volumétrico:
     * largo (cm) x alto (cm) x ancho (cm) / 5,000 
     */
    public function pesoVolumetrico($largo, $alto, $ancho)
    {
        return ($largo * $alto * $ancho) / 5000;
    }

    /**
     * Calcular la tarifa del envío.
     * Fórmula del cálculo de tarifa de envio:
     * ((origen / 1,000) + (destino / 1,000) + (peso)) * (peso volumetrico) .
     */
    public function tarifaEnvio($cpOrigen, $cpDestino, $peso, $pesoVolumetrico)
    {
        return (($cpOrigen / 1000) + ($cpDestino / 1000) + ($peso)) * $pesoVolumetrico;
    }

    /**
     * Generar código de rastreo.
     * de 20 caracteres.
     */
    public function codigoRastreo($envio)
    {
        //Obtenemos la mensajeria con el id del que hayamos elegido
        $mensajeria = mensajeria::findOrFail($envio->id_mensajeria);
        //Eliminamos los espacios en blanco con 'preg_replace' con el pátron '/\s+/' para eliminar espacios en blanco
        $codigoMensajeria = preg_replace('/\s+/', '', substr($mensajeria->nombre, 0, 3) . substr($mensajeria->nombre, -3) );
        //Se concatena el cpOrigen + cpDestino + codigoMensajeria
        $codigoRastreo = $envio->cpOrigen . $envio->cpDestino . $codigoMensajeria;
        //y si hacen falta caracteres llenarlos de forma aleatoria hasta cumplir con el numero de 20
        if(strlen($codigoRastreo) != 20 ){
            if(strlen($codigoRastreo) < 20){
                //convertimos a un valor absoluto los numero faltantes
                $numerosFaltantes = abs(strlen($codigoRastreo) - 20);
                return $codigoRastreo . rand($numerosFaltantes, $numerosFaltantes);
            }else if(strlen($codigoRastreo) > 20){

            }
        }else{
            return $codigoRastreo;
        }

    }

}
