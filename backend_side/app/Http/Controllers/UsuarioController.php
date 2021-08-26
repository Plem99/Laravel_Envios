<?php

namespace App\Http\Controllers;

//Modelo de 'User'
use App\Models\User;

class UsuarioController extends Controller
{
    /**
     * Obtendremos el objeto del usuario con el id proporcionado.
     */
    public function obtenerUsuario($id_usuario)
    {
        //Obtenemos el usaurio con el id que hayamos obtenido
        return User::findOrFail($id_usuario);
    }

}
