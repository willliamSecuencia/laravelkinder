<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluacionEstudiante extends Model
{
    // este hace referencia a la tabla
    protected $table = 'evaluacionestudiante';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'estudiante_id', 'contacto_id','bienvenida','concepto','vocabulario','mes','ausencias',
    ];
}
