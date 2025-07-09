<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
  protected $fillable = ['paciente', 'tipo', 'fecha', 'hora', 'precio', 'estado'];

}
