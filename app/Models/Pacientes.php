<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    protected $fillable = [
        'nombres',
        'apellidos',
        'cedula',
        'telefono',
        'email',
        'sexo',
        'fecha_nacimiento',
        'tipo_ecografia',
        'precio',
        'acciones'
    ];

}
