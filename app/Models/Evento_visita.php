<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento_visita extends Model
{
    protected $fillable = [
        'visita_id',
        'tipo_evento',
        'notas',
        'fecha_hora',
        'latitud',
        'longitud',
        'estado',
    ];
}
