@extends('layouts.app')

@section('content')
    {{-- <h2 class="text-center">Listado de Estudiantes</h2>
    <button type="button" class="btn btn-primary" onclick="window.location='{{ route('studentsquiz.add', ['id'=>Crypt::encrypt(0)]) }}'">
        Evaluar
    </button>
    <hr/>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Fecha Nacimiento</th>
                <th scope="col">Celular de la madre</th>
                <th scope="col">Celular del padre</th>
                <th scope="col">Direccion</th>
                {{-- <th scope="col">Acciones</th> -}}
            </tr>
        </thead>
        <tbody>
            @if(!empty($dataEstudiantes))
                @foreach ($dataEstudiantes as $dataE)
                    <tr>
                        <td>{{ $dataE->nombre }}</td>
                        <td>{{ $dataE->apellido }}</td>
                        <td>{{ $dataE->fechaNacimiento }}</td>
                        <td>{{ !empty($dataE->celularmadre)? $dataE->celularmadre:'Sin datos' }}</td>
                        <td>{{ !empty($dataE->celularpadre)? $dataE->celularpadre:'Sin datos' }}</td>
                        <td>{{ !empty($dataE->direccion)? $dataE->direccion:'Sin datos' }}</td>
                        {{- <td>
                            <a href="{{ route('students.add', ['id'=>Crypt::encrypt($dataE->idestudiante)]) }}"  title="Actualizar"><i class="fa fa-pencil"></i></a>
                            <a href="#" onclick="deleteConfirm('deleteEstudiante{{$dataE->idestudiante}}')"   title="Eliminar"><i class="fa fa-trash"></i></a>
                            <form id="deleteEstudiante{{$dataE->idestudiante}}" action="{{ route('students.delete', [Crypt::encrypt($dataE->idestudiante)]) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                            </form>
                        </td> -}}
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8">Sin Datos</td>
                </tr>
            @endif
        </tbody>
    </table> --}}

    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0" style="color: #c717b5;">Bienvenida profesor(a) {{ Auth::user()->name}}</h3>
            <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{ route('studentsquiz.add', ['id'=>Crypt::encrypt(0)]) }}">
                <strong>Nueva Evaluación</strong>
                <br>
            </a>
        </div>
        <h6>Ultimas evaluaciones</h6>
        <div class="row">
            @if (!empty($dataEstudiantes))
                @foreach ($dataEstudiantes as $dataE)
                    <div class="col-md-6 col-xl-3">
                        <div class="card shadow mb-4">
                            <div class="card-header text-center py-3">
                                <h6 class="text-primary font-weight-bold m-0">{{ $dataE->nombre.' '.$dataE->apellido }}</h6>
                            </div>
                            <div class="d-flex d-xl-flex justify-content-center justify-content-xl-center" style="text-align: center;margin-top: 17px;"><img class="rounded-circle mb-3 mt-4" src="/image/student/{{$dataE->imagen}}" width="160" height="160" style="background: var(--pink);"></div>
                            <div class="card-body" style="text-align: center;">
                                <h5>Evaluation 2021</h5>
                                <a class="btn btn-primary" role="button" href="{{ route('students.add', ['id'=>Crypt::encrypt($dataE->idestudiante)]) }}">Edit</a>
                                <a class="btn btn-primary" role="button" href="#" target="_blank">PDF Export</a>
                            </div>
                        </div>
                    </div>

                @endforeach
            @else
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">No se tienen niveles</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
