<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'correo',
        'password',
        'rol_id',
        'estado',
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function rol()
    {
        return $this->belongsTo(\App\Models\Rol::class, 'rol_id');
    }
}
