<?php

namespace App\Http\Controllers\ItemCriterio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Criterio;
use App\Models\ItemCriterio;

class ItemCriterioController extends Controller
{
    public static $indexM = 'itemcriterio.index';
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
        $entireTable = Criterio::join('nivel', 'criterio.nivel_id', '=' ,'nivel.idnivel')
                                ->select('nivel.descripcion as nivel', 'criterio.*')
                                ->get();
        return view('itemscriterios.index', ['dataCriterio' => $entireTable]);
    }

    /**
     * Mustra todos los estudiantes creados
     *
     * @return Response
     */
    public function listitmcr($id){
        //Validamos que tenga acceso al modulo que esta ingresando
        $result = $this->controladorMenu(self::$indexM);
        if($result->isEmpty()){
            return redirect()->route('home');
        }
        $nombreCN = Criterio::join('nivel', 'criterio.nivel_id', '=' ,'nivel.idnivel')
                                ->where('criterio.idcriterio', Crypt::decrypt($id))
                                ->select('nivel.descripcion as nivel', 'criterio.titulo as criterio')
                                ->get();
        $entireTable = ItemCriterio::where('criterio_id', Crypt::decrypt($id))
                                    ->get();
        return view('itemscriterios.lista', ['dataItems' => $entireTable,'idcriterio' => Crypt::decrypt($id),'nombreCN' => $nombreCN]);
    }

    /**
     * Muestra el formulario para crear el contacto
     *
     */
    public function add($id, $idct){
        //Validamos que tenga acceso al modulo que esta ingresando
        $result = $this->controladorMenu(self::$indexM);
        if($result->isEmpty()){
            return redirect()->route('home');
        }

        $nombreCN = Criterio::join('nivel', 'criterio.nivel_id', '=' ,'nivel.idnivel')
                                ->where('criterio.idcriterio', Crypt::decrypt($idct))
                                ->select('nivel.descripcion as nivel', 'criterio.titulo as criterio')
                                ->get();

        if(Crypt::decrypt($id) == 0){
            return view('itemscriterios.create', ['idcriterio' => Crypt::decrypt($idct),'nombreCN' => $nombreCN]);
        }else{
            $entireTable = ItemCriterio::where('iditemcriterio', Crypt::decrypt($id))
                                        ->get();
            return view('itemscriterios.create', ['dataItem' => $entireTable, 'idcriterio' => Crypt::decrypt($idct),'nombreCN' => $nombreCN]);
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
                'descripcion' => 'required',
            ]
        );
        //Consultamos el id del nivel mediante el id del criterio
        $idniv = Criterio::where('idcriterio',Crypt::decrypt($request->idct))
                        ->select('nivel_id')
                        ->get();
        if(Crypt::decrypt($request->iditem) != 0){
            $updated_or_created = 'updated_at';
        }
        //Insertar o actualizar el contacto o teacher
        ItemCriterio::updateOrInsert(
            [
                'iditemcriterio' => Crypt::decrypt($request->iditem)
            ],
            [
                'descripcion' => $request->descripcion,
                'nivel_id' => $idniv[0]->nivel_id,
                'criterio_id' => Crypt::decrypt($request->idct),
                'estado' => 1,
                $updated_or_created => Now(),
            ]
        );
        $idct = Crypt::decrypt($request->idct);
        return redirect()->route('itemcriterio.listitem', ['id' => Crypt::encrypt($idct)]);
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
