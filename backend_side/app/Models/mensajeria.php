<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mensajeria extends Model
{
    //use HasFactory;
    //Tabla de 'mensajerias'
    protected $table = "mensajerias";
    //Columnas de la tabla
    protected $fillable = [
        'nombre',
        'atencionCliente'
    ];
    //La propiedad del timestaps está disponible
    public $timestamps = true;
}
