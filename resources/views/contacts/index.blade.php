@extends('layouts.app')

@section('content')
    <h2 class="text-center">Listado de Contactos</h2>
    <button type="button" class="btn btn-primary" onclick="window.location='{{ route('contacts.add', ['id'=>Crypt::encrypt(0)]) }}'">
        Nuevo Contacto
    </button>
    <hr/>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Direccion</th>
                <th scope="col">Correo Electronico</th>
                <th scope="col">Telefono</th>
                <th scope="col">Celular</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if (!@empty($dataContacto))
                @foreach ($dataContacto as $dataC)
                    <tr>
                        <td>{{ $dataC->nombre }}</td>
                        <td>{{ $dataC->apellido }}</td>
                        <td>{{ $dataC->direccion }}</td>
                        <td>{{ $dataC->correoelectronico }}</td>
                        <td>{{ $dataC->telefono }}</td>
                        <td>{{ $dataC->celular }}</td>
                        <td>
                            @if($dataC->estado == 1)
                                <strong>Activo</strong>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('contacts.add', ['id'=>Crypt::encrypt($dataC->idcontacto)]) }}"  title="Actualizar"><i class="fa fa-pencil"></i></a>
                            <a href="#" onclick="deleteConfirm('deleteContacto{{$dataC->idcontacto}}')"   title="Eliminar"><i class="fa fa-trash"></i></a>
                            <form id="deleteContacto{{$dataC->idcontacto}}" action="{{ route('contacts.delete', [Crypt::encrypt($dataC->idcontacto)]) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8">Sin Datos</td>
                </tr>
            @endif


        </tbody>
    </table>
@endsection
