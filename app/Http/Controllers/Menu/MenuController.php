<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    //Esto valida que este el usuario este logueado
    public function __construct()
    {
        $this->middleware('auth');
    }

}
