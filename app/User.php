<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UsuarioMenu;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email', 'password','contacto_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Muestra los modulos a los cuales tiene permiso el perfil
     *
     * @return Response
     */
    public function dataPerfil($id){
        $entireTable = UsuarioMenu::join('menus', 'usersmenus.menu_id', '=', 'menus.idmenu')
                                    ->where('usersmenus.user_id', $id)
                                    ->select('nombremenu', 'prefijo', 'icon')
                                    ->get();
        return $entireTable;
    }

}
