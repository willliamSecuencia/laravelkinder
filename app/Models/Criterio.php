<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criterio extends Model
{
    // este hace referencia a la tabla
    protected $table = 'criterio';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nivel_id','titulo', 'descripcion',
    ];
}
