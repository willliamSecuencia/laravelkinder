<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCriterio extends Model
{
    // este hace referencia a la tabla
    protected $table = 'itemcriterio';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'criterio_id', 'nivel_id','descripcion',
    ];
}
