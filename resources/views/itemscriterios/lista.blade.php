@extends('layouts.app')

@section('content')
    <h2 class="text-center">Items por criterio - <strong>{{ $nombreCN[0]->criterio }} - {{ $nombreCN[0]->nivel }}</strong></h2>
    <button type="button" class="btn btn-primary" onclick="window.location='{{ route('itemcriterio.index') }}'">
        Volver al listado de Criterios
    </button>
    <button type="button" class="btn btn-primary" onclick="window.location='{{ route('itemcriterio.add', ['id'=>Crypt::encrypt(0),'idct' =>Crypt::encrypt($idcriterio)]) }}'">
        Nuevo Item
    </button>
    <hr/>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Descripcion</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($dataItems))
                @foreach ($dataItems as $dataIt)
                    <tr>
                        <td>{{ $dataIt->descripcion }}</td>
                        <td>
                            <a href="{{ route('itemcriterio.add', ['id'=>Crypt::encrypt($dataIt->iditemcriterio),'idct' =>Crypt::encrypt($idcriterio)]) }}"  title="Actualizar"><i class="fa fa-pencil"></i></a>
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
