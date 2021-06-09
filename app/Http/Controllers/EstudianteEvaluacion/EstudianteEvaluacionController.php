<?php

namespace App\Http\Controllers\EstudianteEvaluacion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class EstudianteEvaluacionController extends Controller
{
    public static $indexM = 'studentsquiz.index';
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
        //Realizamos el llamado a la función para traer el id del profesor
        $idc = $this->idProfesor();
        $dataEstudiantes = Estudiante::join('evaluacionestudiante', 'evaluacionestudiante.estudiante_id', '=' ,'estudiante.idestudiante')
                                ->where('evaluacionestudiante.estudiante_id', $idc)
                                ->select('evaluacionestudiante.*', 'estudiante.*')
                                ->get();
        return view('studentsquiz.index', ['dataEstudiantes' => $dataEstudiantes]);
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
        //Realizamos el llamado a la función para traer el id del profesor
        $idc = $this->idProfesor();
        $dataEstudiantes = Estudiante::join('contactos', 'contactos.idcontacto', '=' ,'estudiante.contacto_id')
                                    ->join('nivel', 'nivel.idnivel', '=' ,'estudiante.nivel_id')
                                    ->where('estudiante.contacto_id', $idc)
                                    ->select('estudiante.*','nivel.descripcion')
                                    ->orderByRaw('estudiante.nivel_id ASC')
                                    ->get();
        // dd($dataEstudiantes);
        if(Crypt::decrypt($id) == 0){
            return view('studentsquiz.create', ['dataEstudiante' => $dataEstudiantes]);
        }else{
            // $entireTable = Estudiante::where('idestudiante',Crypt::decrypt($id))
            //                         ->get();
            return view('studentsquiz.create', ['dataEstudiante' => $dataEstudiantes]);
        }
    }

    /**
     * Crear o actualizar estudiante
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request){
        // $nameimage = 'defaultavatar.png';
        // $updated_or_created = 'created_at';
        // $this->validate($request,
        //     [
        //         'nombre' => 'required',
        //         'apellido' => 'required',
        //         'fechaNacimiento' => 'required',
        //         'profesores' => 'required',
        //         'nivel' => 'required',
        //         'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     ]
        // );

        // if($request->hasFile('imagen')){
        //     $file = $request->file('imagen');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = time().'_'.$request->nombre.$request->apellido.''.'.'.$extension;
        //     $nameimage = $filename;
        //     $file->move('image/student/', $filename);
        // }
        // if(Crypt::decrypt($request->idestudiante) != 0){
        //     $updated_or_created = 'updated_at';
        // }
        // Estudiante::updateOrInsert(
        //     [
        //         'idestudiante' => Crypt::decrypt($request->idestudiante)
        //     ],
        //     [
        //         'nivel_id' => $request->nivel,
        //         'contacto_id' => $request->profesores,
        //         'nombre' => $request->nombre,
        //         'apellido' => $request->apellido,
        //         'fechaNacimiento' => $request->fechaNacimiento,
        //         'celularpadre' => $request->celularpadre,
        //         'celularmadre' => $request->celularmadre,
        //         'direccion' => $request->direccion,
        //         'imagen' => $nameimage,
        //         'estado' => 1,
        //         $updated_or_created => Now(),
        //     ]
        // );

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
        // $result = $this->controladorMenu(self::$indexM);
        // if($result->isEmpty()){
        //     return redirect()->route('home');
        // }
        // Estudiante::where('idestudiante', Crypt::decrypt($id))
        //             ->update(['estado' => 0]);

        return redirect()->route('students.index');
    }

    /**
     * Este proceso traer el id del contacto, en este caso del docente
     *
     * @return Response
     */
    public function idProfesor(){
        $idcontacto = User::select('contacto_id')
                            ->where('users.id',Auth::id())
                            ->get();
        return $idcontacto[0]->contacto_id;
    }
}
