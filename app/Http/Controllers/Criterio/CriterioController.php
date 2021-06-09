<?php

namespace App\Http\Controllers\Criterio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Criterio;
use App\Models\Nivel;

class CriterioController extends Controller
{
    public static $indexM = 'criterio.index';
    //Esto valida que este el usuario este logueado
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Mustra todos los estudiantes creados
     *
     * @return Response
     */
    public function index(){
        //Validamos que tenga acceso al modulo que esta ingresando
        $result = $this->controladorMenu(self::$indexM);
        if($result->isEmpty()){
            return redirect()->route('home');
        }
        $entireTable = Nivel::get();
        return view('criterio.index', ['dataNivel' => $entireTable]);
    }

    /**
     * Mustra todos los estudiantes creados
     *
     * @return Response
     */
    public function listcn($id){
        //Validamos que tenga acceso al modulo que esta ingresando
        $result = $this->controladorMenu(self::$indexM);
        if($result->isEmpty()){
            return redirect()->route('home');
        }
        $entireTable = Criterio::where('nivel_id', Crypt::decrypt($id))
                                ->get();
        return view('criterio.lista', ['dataCriterio' => $entireTable,'idnivel' => Crypt::decrypt($id)]);
    }

    /**
     * Muestra el formulario para crear el contacto
     *
     */
    public function add($id, $idn){
        //Validamos que tenga acceso al modulo que esta ingresando
        $result = $this->controladorMenu(self::$indexM);
        if($result->isEmpty()){
            return redirect()->route('home');
        }

        if(Crypt::decrypt($id) == 0){
            return view('criterio.create', ['dataNivel' => Crypt::decrypt($idn)]);
        }else{
            $entireTable = Criterio::where('idcriterio',Crypt::decrypt($id))
                                    ->get();
            return view('criterio.create', ['dataCriterio' => $entireTable, 'dataNivel' => Crypt::decrypt($idn)]);
        }
    }

    /**
     * Crear o actualizar el contacto
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request){
        //Validamos que tenga acceso al modulo que esta ingresando
        $result = $this->controladorMenu(self::$indexM);
        if($result->isEmpty()){
            return redirect()->route('home');
        }
        $updated_or_created = 'created_at';
        $this->validate($request,
            [
                'titulo' => 'required',
                'descripcion' => 'required',
            ]
        );
        if(Crypt::decrypt($request->idcriterio) != 0){
            $updated_or_created = 'updated_at';
        }
        //Insertar o actualizar el contacto o teacher
        Criterio::updateOrInsert(
            [
                'idcriterio' => Crypt::decrypt($request->idcriterio)
            ],
            [
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'nivel_id' => Crypt::decrypt($request->idn),
                'estado' => 1,
                $updated_or_created => Now(),
            ]
        );
        $idnv = Crypt::decrypt($request->idn);
        return redirect()->route('criterio.listacriterio', ['id' => Crypt::encrypt($idnv)]);
    }

    /**
     * Este proceso para inactivar el contacto y eliminarlo de la tabla para el logueo
     *
     * @param Contacto id $id
     * @return Response
     */
    public function delete($id){
        dd(Crypt::decrypt($id));
        //Validamos que tenga acceso al modulo que esta ingresando
        $result = $this->controladorMenu(self::$indexM);
        if($result->isEmpty()){
            return redirect()->route('home');
        }
        // $userLog = User::where('contacto_id', $id)
        //                     ->get();
        // if(!empty($userLog)){
        //     User::where('contacto_id', $id)
        //         ->delete();
        // }
        // Contacto::where('idcontacto', $id)
        //          ->update(['estado' => 0]);
        // return redirect('/criterio');
    }
}
