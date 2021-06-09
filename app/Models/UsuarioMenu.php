<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioMenu extends Model
{
    protected $table = 'usersmenus';// este hace referencia a la tabla

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'menu_id'
    ];
}
