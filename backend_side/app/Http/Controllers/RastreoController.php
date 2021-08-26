<?php

namespace App\Http\Controllers;

//Modelo de 'rastreo'
use App\Models\rastreo;
use Illuminate\Http\Request;

class RastreoController extends Controller
{
    //Caracteres necesarios para el codigo de rastreo
    private const VALOR_CODIGO = 20; 

    /**
     * Generar código de rastreo de 20 caracteres.
     * Esperamos un object en donde estara nuestro registro de envio.
     */
    public function codigoRastreo($registroEnvio)
    {
        //Obtenemos la mensajeria con el id del que hayamos elegido
        $mensajeria = app(MensajeriaController::class)->obtenerMensajeria($registroEnvio->id_mensajeria);
        //Eliminamos los espacios en blanco con 'preg_replace()' con el pátron '/\s+/' para eliminar espacios en blanco y,
            //concatenamos parte del nombre de la mensajeria elegida
        $codigoMensajeria = preg_replace('/\s+/', '', substr($mensajeria->nombre, 0, 3) . substr($mensajeria->nombre, -3) );
        //Se concatena el cpOrigen + cpDestino + codigoMensajeria
        $codigoRastreo = $registroEnvio->cpOrigen . $registroEnvio->cpDestino . $codigoMensajeria;
        //Hacemos un ciclo para verificar que el codigo de rastreo sea valido
        while(true){
            //Guardamos el valor obtenido por la validacion
            $codigoRastreoTemporal = $this->validarCodigoRastreo($codigoRastreo);
            if($codigoRastreoTemporal){ //En el caso de que el valor no se encuentre en la base de datos rompe el ciclo
                break;
            }
        }
        //Guardamos el valor final del codigo en nuestra variable local
        $codigoRastreo = $codigoRastreoTemporal;
        //Guardamos nuestro registro de rastreo del envio
        $registroRastreo = rastreo::create([
            'codigo' => $codigoRastreo,
            'estado' => 'En espera',
            'id_envio' => $registroEnvio->id
        ]);
        //Retornamos el valor del registro del rastreo
        return response([
            'codigo' => $registroRastreo->codigo, 
            'estado' => $registroRastreo->estado,
            'mensajeria' => $mensajeria->nombre
        ]);
        

    }

    /**
     * Validamos si el código de rastreo es apto.
     */
    public function validarCodigoRastreo($codigoRastreo)
    {
        //Si hacen falta caracteres llenarlos de forma aleatoria hasta cumplir con el numero de 20
        if(strlen($codigoRastreo) != self::VALOR_CODIGO ){
            if(strlen($codigoRastreo) < self::VALOR_CODIGO){    //En el caso de ser menor a 20 caracteres
                //Convertimos a un valor absoluto los numeros faltantes
                $numerosFaltantes = abs(strlen($codigoRastreo) - self::VALOR_CODIGO);
                //Va a dar la cantidad necesaria para calcular los 20 caracteres
                for($i = self::VALOR_CODIGO - $numerosFaltantes; $i < self::VALOR_CODIGO; $i++){
                    //Usamos el método 'str_pad()' para rellenar el string con un numero de caracteres definidos y,
                        //generamos los numeros aleatorios
                    $codigoRastreo = str_pad($codigoRastreo,  $i+1, strval(mt_rand(0, 9))); //Vamos sumando los numeros necesarios a rellenar hasta el 20
                }
            }else if(strlen($codigoRastreo) > self::VALOR_CODIGO){  //En el caso de ser mayor a 20 caracteres
                //Solo recortamos la cadena de texto hasta 20 caracteres
                $codigoRastreo = substr($codigoRastreo, 0, self::VALOR_CODIGO);
            }
            //Usamos una condicion ternaria para validar si el valor calculado no esta registrado en la base de datos,
                //esto con el fin de evitar duplicidades
            return !rastreo::where('codigo', '=', $codigoRastreo)->first('codigo') ? $codigoRastreo : false;
        }else{
            return !rastreo::where('codigo', '=', $codigoRastreo)->first('codigo') ? $codigoRastreo : false;
        }
    }

    /**
     * Rastreamos el envio por medio del codigo de rastreo.
     * 
     */
    public function rastrearEnvio($codigo){
        //Guardamos el objeto de nuestra consulta
        $rastreoEnvio = rastreo::where('codigo', '=', $codigo)->first();
        if($rastreoEnvio){  //Si existe retorna datos de interes
            return response()->json([
                'Código de Rastreo' => $rastreoEnvio->codigo,
                'Estado del Envío' => $rastreoEnvio->estado,
                'Registro Creado' => $rastreoEnvio->created_at,
                'Registro Actualizado' => $rastreoEnvio->updated_at
            ], 200);
        }else{  //Si no, retorna un mensaje de orden inválida
            return response()->json([
                'message' => 'No existe la orden de rastreo'
            ], 404);
        }
    }
}
