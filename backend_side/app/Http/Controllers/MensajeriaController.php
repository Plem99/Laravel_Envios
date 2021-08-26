<?php

namespace App\Http\Controllers;

//Modelo de 'mensajeria'
use App\Models\mensajeria;
// use Illuminate\Http\Request;

class MensajeriaController extends Controller
{
    /**
     * Obtendremos el objeto de mensajeria con el id proporcionado.
     */
    public function obtenerMensajeria($id_mensajeria)
    {
        //Obtenemos la mensajeria con el id que hayamos obtenido
        return mensajeria::findOrFail($id_mensajeria);
    }
}
