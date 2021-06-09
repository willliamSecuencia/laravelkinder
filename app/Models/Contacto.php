<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    // este hace referencia a la tabla
    protected $table = 'contactos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idcontacto', 'tipousuario_id', 'nombre', 'apellido', 'nit', 'direccion','correoelectronico','telefono','celular','estado',
    ];
}
