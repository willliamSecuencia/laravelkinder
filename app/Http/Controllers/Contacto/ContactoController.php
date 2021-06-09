<?php

namespace App\Http\Controllers\Contacto;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Contacto;
use App\Models\TipoUsuario;
use App\User;

class ContactoController extends Controller
{
    public static $indexM = 'contacts.index';
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
        $entireTable = Contacto::where('estado','<>', 0)
                                ->orderByRaw('created_at DESC')
                                ->get();
        return view('contacts.index', ['dataContacto' => $entireTable]);
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

        $tableTipoUser = TipoUsuario::get();
        if(Crypt::decrypt($id)== 0){
            return view('contacts.create', ['dataTipoUsuario' => $tableTipoUser]);
        }else{
            $entireTable = Contacto::where('idcontacto', Crypt::decrypt($id))
                                    ->get();
            return view('contacts.create', ['dataContacto' => $entireTable, 'dataTipoUsuario' => $tableTipoUser]);
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
        $this->validate($request,
            [
                'nombre' => 'required',
                'apellido' => 'required',
                'tipousuario' => 'required',
                'nit' => 'required',
                'correoelectronico' => 'required|email',
            ],
            ['required' => 'El :attribute es requerido.']
        );

        if(Crypt::decrypt($request->idcontacto) != 0){
            $updated_or_created = 'updated_at';
        }
        //Insertar o actualizar el contacto o teacher
        Contacto::updateOrInsert(
            [
                'idcontacto' => Crypt::decrypt($request->idcontacto)
            ],
            [
                'tipousuario_id' => $request->tipousuario,
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'nit' => $request->nit,
                'direccion' => $request->direccion,
                'correoelectronico' => $request->correoelectronico,
                'telefono' => $request->telefono,
                'celular' => $request->celular,
                'estado' => $request->estado,
                $updated_or_created => Now(),
            ]
        );
        //Consultar el id creado
        if(Crypt::decrypt($request->idcontacto) == 0){
            $idinsert = Contacto::latest()
                                ->select('idcontacto')
                                ->first();
            $firstwordName = substr($request->nombre, 0, 2);
            $firstwordLastName = substr($request->apellido, 0, 2);

            $pass = strtoupper($firstwordName).strtoupper($firstwordLastName).$request->nit.'*';
            User::create([
                'name' => $request->nombre.' '.$request->apellido,
                'email' => $request->correoelectronico,
                'contacto_id' => $idinsert->idcontacto,
                'password' => Hash::make($pass),
            ]);
        }

        return redirect()->route('contacts.index');
    }

    /**
     * Este proceso para inactivar el contacto y eliminarlo de la tabla para el logueo
     *
     * @param Contacto id $id
     * @return Response
     */
    public function delete($id){
        //Validamos que tenga acceso al modulo que esta ingresando
        $result = $this->controladorMenu(self::$indexM);
        if($result->isEmpty()){
            return redirect()->route('home');
        }
        $userLog = User::where('contacto_id', Crypt::decrypt($id))
                            ->get();
        if(!empty($userLog)){
            User::where('contacto_id', Crypt::decrypt($id))
                ->delete();
        }
        Contacto::where('idcontacto', Crypt::decrypt($id))
                 ->update(['estado' => 0]);

        return redirect()->route('contacts.index');
    }

}
