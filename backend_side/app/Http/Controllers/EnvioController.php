<?php

namespace App\Http\Controllers;

//Modelo de 'envio'
use App\Models\envio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class EnvioController extends Controller
{
    /**
     * Se válida los datos que se reciben con el metodo de Envio
     * 
     * @return \Illuminate\Http\Request  $request
     */
    public function validarEnvio(Request $request)
    {
        //Almacenamos las reglas y mensajes que se mostraran en caso de ser necesario
        $reglas = $this->reglasEnvio();
        $mensajes = $this->reglasMensajes();
        //Guardamos la validación para despues manejarla
        $validacion = Validator::make($request->all(), $reglas, $mensajes);
        if($validacion->fails()){   //Si falla imprime los mensajes necesarios
            return response()->json([
                'message' => $validacion->customMessages
            ], 201);
        }else{  //Si no, hace las demas configuraciones para crear un nuevo envio
            return $this->registrarEnvio($request);
        }
        
    }

    /**
     * Crea un nuevo envio con los datos enviados.
     */
    public function registrarEnvio($request)
    {
        //Obtenemos el peso volumetrico
        $pesoVolumetrico = $this->pesoVolumetrico($request->largo, $request->alto, $request->ancho);
        //Calculamos la tarifa del envio redondeandola a 2 cifras significativas
        $tarifaEnvio = round($this->tarifaEnvio(intval($request->cpOrigen), intval($request->cpDestino), $request->peso, $pesoVolumetrico), 2);
        //Creamos nuestro registro en nuestra base de datos
        $registroEnvio = envio::create([
            'cpOrigen' => $request->cpOrigen,
            'cpDestino' => $request->cpDestino,
            'peso' => $request->peso,
            'largo' => $request->largo,
            'alto' => $request->alto,
            'ancho' => $request->ancho,
            'tarifa' => $tarifaEnvio,
            'id_usuario' => $request->id_usuario,
            'id_mensajeria' => $request->id_mensajeria
        ]);
        //Obtenemos datos de rastreo creado
        $datosRastreo = app(RastreoController::class)->codigoRastreo($registroEnvio);
        //Obtenemos los datos de usuario usado
        $usuario = app(UsuarioController::class)->obtenerUsuario($request->id_usuario);
        //Retornamos la respuesta de nuestro registro de envío
        return response()->json([
            'Usuario' => $usuario->name,
            'Código de Rastreo' => $datosRastreo->original['codigo'],
            'Mensajeria' => $datosRastreo->original['mensajeria'],
            'Estado del Envío' => $datosRastreo->original['estado'],
            'Tarifa de Envío (MXN)' => $tarifaEnvio,
            'id' => $registroEnvio->id
        ], 201);
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
        return (($cpOrigen / 1000) + ($cpDestino / 1000) + $peso) * $pesoVolumetrico;
    }

    /**
     * Se agregan las reglas que debe seguir la validación
     */
    public function reglasEnvio(){
        return [
            'cpOrigen' => 'required | min:5 | max:5',
            'cpDestino' => 'required | min:5 | max:5',
            'peso' => 'required | min:1 | max:3',
            'largo' => 'required | min:1 | max:3',
            'alto' => 'required | min:1 | max:3',
            'ancho' => 'required | min:1 | max:3'
        ];
    }
    /**
     * Escribimos los mensajes en caso de que alguna regla falle
     */
    public function reglasMensajes(){
        return [
            'cpOrigen' => 'Requerido y minimo y máximo 5 caracteres',
            'cpDestino' => 'Requerido y minimo y máximo 5 caracteres',
            'peso' => 'Requerido y máximo 3 cifras de números enteros',
            'largo' => 'Requerido y máximo 3 cifras de números enteros',
            'alto' => 'Requerido y máximo 3 cifras de números enteros',
            'ancho' => 'Requerido y máximo 3 cifras de números enteros',
        ];
    }

}
