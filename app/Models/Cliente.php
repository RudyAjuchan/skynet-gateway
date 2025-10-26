<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
    'nombre',
    'direccion',
    'telefono_contacto',
    'correo_contacto',
    'latitud',
    'longitud',
    'estado'
];
}
