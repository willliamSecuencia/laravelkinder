<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    // este hace referencia a la tabla
    protected $table = 'estudiante';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nivel_id', 'contacto_id','nombre','apellido','fechaNacimiento','celularpadre','celularmadre', 'direccion', 'imagen', 'estado',
    ];
}
