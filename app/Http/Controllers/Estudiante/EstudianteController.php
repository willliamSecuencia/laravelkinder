<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Nivel;
use App\Models\Contacto;

class EstudianteController extends Controller
{
    public static $indexM = 'students.index';
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
        $entireTablea = Estudiante::where('estado','<>', 0)
                                ->orderByRaw('created_at DESC')
                                ->get();
        return view('students.index', ['dataEstudiante' => $entireTablea]);
    }

    /**
     * Muestra el formulario para crear el estudiante
     *
     */
    public function add($id){
        //Validamos que tenga acceso al modulo que esta ingresando
        $result = $this->controladorMenu(self::$indexM);
        if($result->isEmpty()){
            return redirect()->route('home');
        }
        $nivel = Nivel::select('idnivel','descripcion')
                ->get();
        $contacto = Contacto::select('idcontacto','nombre', 'apellido')
                            ->where('tipousuario_id',2)
                            ->get();
        if(Crypt::decrypt($id) == 0){
            return view('students.create', ['dataNivel' => $nivel, 'dataContacto' =>$contacto]);
        }else{
            $entireTable = Estudiante::where('idestudiante',Crypt::decrypt($id))
                                    ->get();
            return view('students.create', ['dataEstudiante' => $entireTable,'dataNivel' => $nivel, 'dataContacto' =>$contacto]);
        }
    }

    /**
     * Crear o actualizar estudiante
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request){
        $nameimage = 'defaultavatar.png';
        $updated_or_created = 'created_at';
        $this->validate($request,
            [
                'nombre' => 'required',
                'apellido' => 'required',
                'fechaNacimiento' => 'required',
                'profesores' => 'required',
                'nivel' => 'required',
                'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );
        if(Crypt::decrypt($request->idestudiante) != 0){
            $updated_or_created = 'updated_at';
            if($request->hasFile('imagen')){
                $file = $request->file('imagen');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'_'.$request->nombre.$request->apellido.''.'.'.$extension;
                $nameimage = $filename;
                $file->move('image/student/', $filename);
            }else{
                $nameimage = $request->imgestudiante;
            }
        }else{
            if($request->hasFile('imagen')){
                $file = $request->file('imagen');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'_'.$request->nombre.$request->apellido.''.'.'.$extension;
                $nameimage = $filename;
                $file->move('image/student/', $filename);
            }
        }
        Estudiante::updateOrInsert(
            [
                'idestudiante' => Crypt::decrypt($request->idestudiante)
            ],
            [
                'nivel_id' => $request->nivel,
                'contacto_id' => $request->profesores,
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'fechaNacimiento' => $request->fechaNacimiento,
                'celularpadre' => $request->celularpadre,
                'celularmadre' => $request->celularmadre,
                'direccion' => $request->direccion,
                'imagen' => $nameimage,
                'estado' => 1,
                $updated_or_created => Now(),
            ]
        );

        return redirect()->route('students.index');
    }

    /**
     * Este proceso para inactivar el estudiante
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
        Estudiante::where('idestudiante', Crypt::decrypt($id))
                    ->update(['estado' => 0]);

        return redirect()->route('students.index');
    }
}
