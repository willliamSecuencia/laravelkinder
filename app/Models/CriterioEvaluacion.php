<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CriterioEvaluacion extends Model
{
    // este hace referencia a la tabla
    protected $table = 'criterioevaluacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'evaluacionestudiante_id', 'listacriterio_id',
    ];
}
