@extends('layouts.app')

@section('content')
    <h2 class="text-center">Listado de Criterios</h2>
    <button type="button" class="btn btn-primary" onclick="window.location='{{ route('criterio.index') }}'">
        Volver al listado de niveles
    </button>
    <button type="button" class="btn btn-primary" onclick="window.location='{{ route('criterio.add', ['id'=>Crypt::encrypt(0),'idn' =>Crypt::encrypt($idnivel)]) }}'">
        Nuevo Criterio
    </button>
    <hr/>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Titulo</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($dataCriterio))
                @foreach ($dataCriterio as $dataCr)
                    <tr>
                        <td>{{ $dataCr->titulo }}</td>
                        <td>{{ $dataCr->descripcion }}</td>
                        <td>
                            <a href="{{ route('criterio.add', ['id'=>Crypt::encrypt($dataCr->idcriterio),'idn' =>Crypt::encrypt($idnivel)]) }}"  title="Actualizar"><i class="fa fa-pencil"></i></a>
                            {{-- <a href="#" onclick="deleteConfirm('deleteCriterio{{$dataCr->idcriterio}}')"   title="Eliminar"><i class="fa fa-trash"></i></a>
                            <form id="deleteCriterio{{$dataCr->idcriterio}}" action="{{ route('criterio.delete', [Crypt::encrypt($dataCr->idcriterio)]) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">Sin Datos</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
