<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rastreo extends Model
{
    //use HasFactory;
    //Tabla de 'rastreos'
    protected $table = "rastreos";
    //Columnas de la tabla
    protected $fillable = [
        'codigo',
        'estado',
        'id_envio'
    ];
    //La propiedad del timestaps está disponible
    public $timestamps = true;
}
