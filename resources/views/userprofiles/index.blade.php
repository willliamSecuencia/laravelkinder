@extends('layouts.app')

@section('content')
    <h2 class="text-center">Listado de perfiles por usuario</h2>
    <button type="button" class="btn btn-primary" onclick="window.location='{{ route('userprofiles.add', ['id'=>Crypt::encrypt(0)]) }}'">
        Nuevo Perfil
    </button>
    <hr/>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Usuario</th>
                <th scope="col">Menu asignado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if(!@empty($dataUserPerfil))
                @foreach ($dataUserPerfil as $dataUP)
                    <tr>
                        <td>{{ $dataUP->name }}</td>
                        <td>{{ $dataUP->menus }}</td>
                        <td>
                            @foreach ($dataUser as $dtuser)

                                @if ($dtuser->name == $dataUP->name)

                                    <a href="{{ route('userprofiles.add', ['id'=>Crypt::encrypt($dtuser->contacto_id)]) }}"  title="Actualizar" style="cursor: pointer;"><i class="fa fa-pencil"></i></a>
                                    <a href="#" onclick="deleteConfirm('deleteEstudiante{{$dtuser->contacto_id}}')"  title="Eliminar" style="cursor: pointer;"><i class="fa fa-trash"></i></a>
                                    <form id="deleteEstudiante{{$dtuser->contacto_id}}" action="{{ route('userprofiles.delete', [Crypt::encrypt($dtuser->contacto_id)]) }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    </form>

                                @endif

                            @endforeach
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
