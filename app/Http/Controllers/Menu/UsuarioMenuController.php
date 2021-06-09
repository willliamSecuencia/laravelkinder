<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsuarioMenu;

class UsuarioMenuController extends Controller
{
    //Esto valida que este el usuario este logueado
    public function __construct()
    {
        $this->middleware('auth');
    }
}
