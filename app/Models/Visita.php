<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    protected $fillable = [
        'cliente_id',
        'supervisor_id',
        'tecnico_id',
        'fecha_programada',
        'estado_visita',
        'estado'
    ];
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function tecnico()
    {
        return $this->belongsTo(Usuario::class, 'tecnico_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(Usuario::class, 'supervisor_id');
    }

    public function eventoVisita()
    {
        return $this->hasMany(Evento_visita::class, 'visita_id');
    }
}
