<?php

namespace App\Http\Controllers\PerfilesUsuario;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\UsuarioMenu;
use App\Models\Menu;
use App\Models\Contacto;

class PerfilesUsuarioController extends Controller
{
    public static $indexM = 'userprofiles.index';
    //Esto valida que este el usuario este logueado
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Mustra todos los contactos creados
     *
     * @return Response
     */
    public function index(){
        //Validamos que tenga acceso al modulo que esta ingresando
        $result = $this->controladorMenu(self::$indexM);
        if($result->isEmpty()){
            return redirect()->route('home');
        }
        $dataMenuUser = UsuarioMenu::join('menus', 'usersmenus.menu_id', '=', 'menus.idmenu')
                                    ->join('users', 'usersmenus.user_id', '=' ,'users.contacto_id')
                                    ->select('name')
                                    ->selectRaw("GROUP_CONCAT(menus.nombremenu SEPARATOR ';') AS menus")
                                    ->groupBy('users.name')
                                    ->get();
        $dataUser = UsuarioMenu::join('users', 'usersmenus.user_id', '=' ,'users.contacto_id')
                                ->select('name', 'contacto_id')
                                ->groupByRaw('name, contacto_id')
                                ->get();
        return view('userprofiles.index', ['dataUserPerfil' => $dataMenuUser, 'dataUser' => $dataUser]);
    }

    /**
     * Muestra el formulario para crear el contacto
     *
     */
    public function add($id){
        //Validamos que tenga acceso al modulo que esta ingresando
        $result = $this->controladorMenu(self::$indexM);
        if($result->isEmpty()){
            return redirect()->route('home');

        }
        $lisMenu = Menu::get();
        if(Crypt::decrypt($id) == 0){
            $lisContacto = Contacto::whereNotIn('idcontacto', function($query){
                                        $query->select('user_id')->from('usersmenus');
                                    })
                                    ->select('idcontacto', 'nombre', 'apellido')
                                    ->get();
            return view('userprofiles.create', ['dataMenu' => $lisMenu, 'dataContact' => $lisContacto, 'updateorinsert' => Crypt::decrypt($id) ]);
        }else{
            $listUser = UsuarioMenu::where('user_id', Crypt::decrypt($id))
                                    ->get();
            $lisContacto = Contacto::select('nombre', 'apellido')
                                    ->where('idcontacto', Crypt::decrypt($id))
                                    ->get();
            return view('userprofiles.create', ['dataUserP' => $listUser, 'dataMenu' => $lisMenu, 'dataContact' => $lisContacto, 'updateorinsert' => Crypt::decrypt($id)]);
        }
    }

    /**
     * Crear o actualizar el contacto
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request){
        $updated_or_created = 'created_at';
        $cnt = 0;

        // Proceso para validar los campos requeridos
        if(Crypt::decrypt($request->idcontacto) != 0){
            $updated_or_created = 'updated_at';
            $this->validate($request,
                [
                    'menulista' => 'required|min:1|present',
                ]
            );

            //Primero realizaremos la eliminación para poder volver a crear todos los datos cuando se estan editando
            UsuarioMenu::where('user_id', Crypt::decrypt($request->idcontacto))
                        ->delete();
            $cnt = Crypt::decrypt($request->idcontacto);
        }else{
            $this->validate($request,
                [
                    'contacto' => 'required',
                    'menulista' => 'required|min:1|present',
                ]
            );
            // Esta es la opción para insertar, por tal motivo se toma el $request->contacto del select
            $cnt = $request->contacto;
        }
        foreach($request->menulista as $datamn){
            UsuarioMenu::create(
                [
                    'user_id' => $cnt,
                    'menu_id' => $datamn,
                    $updated_or_created => Now(),
                ]
            );
        }

        return redirect()->route('userprofiles.index');
    }

    /**
     * Este proceso para eliminar los datos asociados al perfil
     *
     * @param User id $id
     * @return Response
     */
    public function delete($id){
        //Validamos que tenga acceso al modulo que esta ingresando
        $result = $this->controladorMenu(self::$indexM);
        if($result->isEmpty()){
            return redirect()->route('home');
        }
        UsuarioMenu::where('user_id', Crypt::decrypt($id))
                    ->delete();

        return redirect()->route('userprofiles.index');
    }

}
