<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class envio extends Model
{
    //use HasFactory;
    //Tabla de 'envios'
    protected $table = "envios";
    //Columnas de la tabla
    protected $fillable = [
        'cpOrigen',
        'cpDestino',
        'peso',
        'largo',
        'alto',
        'ancho',
        'tarifa',
        'id_usuario',
        'id_mensajeria'
    ];
    //La propiedad del timestaps está disponible
    public $timestamps = true;
    //Ocultamos los datos que no queremos que se retornen
    protected $hidden = [
        'id_usuario',
        'id_mensajeria'
    ];
}
