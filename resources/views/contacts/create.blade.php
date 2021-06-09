@extends('layouts.app')

@section('content')
    <h2 class="text-center">Datos Contacto</h2>
    <div class="card-body">
        <form action="{{ route('contacts.store')}}" method="POST">
            @csrf
            <div class="form-group row">
                <select name="tipousuario" id="tipousuario" class="form-control {{ $errors->has('tipousuario') ? ' is-invalid':'' }}">

                    @if (!empty($dataContacto))

                        @foreach ($dataTipoUsuario as $tipouser)
                            @if ($dataContacto[0]->tipousuario_id == $tipouser->idtipousuario)
                                <option value="{{ $tipouser->idtipousuario }}">{{ $tipouser->descripcion}}</option>
                            @endif
                        @endforeach
                        <option value="">Seleccione tipo de usuario</option>
                        @foreach ($dataTipoUsuario as $tipouser)
                            @if ($dataContacto[0]->tipousuario_id != $tipouser->idtipousuario)
                                <option value="{{ $tipouser->idtipousuario }}">{{ $tipouser->descripcion}}</option>
                            @endif
                        @endforeach

                    @else
                        <option value="">Seleccione tipo de usuario</option>
                        @foreach ($dataTipoUsuario as $tipouser)
                            <option value="{{ $tipouser->idtipousuario }}">{{ $tipouser->descripcion}}</option>
                        @endforeach
                    @endif
                </select>
                @if ($errors->has('tipousuario'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tipousuario') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row">
                <input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid':'' }}" id="nombre" name="nombre" placeholder="Nombres" value="{{ !empty($dataContacto) ? $dataContacto[0]->nombre:old('nombre')}}">

                {{-- Este validador es necesario para poder mostrar el mensaje --}}
                @if ($errors->has('nombre'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row">
                <input type="text" class="form-control{{ $errors->has('apellido') ? ' is-invalid':'' }}" id="apellido" name="apellido" placeholder="Apellidos" value="{{ !empty($dataContacto) ? $dataContacto[0]->apellido:old('apellido')}}" >
                @if ($errors->has('apellido'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('apellido') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row">
                <input type="text" class="form-control{{ $errors->has('nit') ? ' is-invalid':'' }}" id="nit" name="nit" placeholder="NIT o Documento de identificación" value="{{ !empty($dataContacto) ? $dataContacto[0]->nit:old('nit')}}">

                {{-- Este validador es necesario para poder mostrar el mensaje --}}
                @if ($errors->has('nit'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nit') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row">
                <input type="text" class="form-control{{ $errors->has('direccion') ? ' is-invalid':'' }}" id="direccion" name="direccion" placeholder="direccion" value="{{ !empty($dataContacto) ? $dataContacto[0]->direccion:old('direccion')}}">
            </div>
            <div class="form-group row">
                <input type="email" class="form-control{{ $errors->has('correoelectronico') ? ' is-invalid':'' }}" id="correoelectronico" name="correoelectronico" placeholder="nombre@direcion.com"  value="{{ !empty($dataContacto) ? $dataContacto[0]->correoelectronico:old('correoelectronico')}}">
                @if ($errors->has('correoelectronico'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('correoelectronico') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row">
                <input type="text" class="form-control{{ $errors->has('telefono') ? ' is-invalid':'' }}" id="telefono" name="telefono" placeholder="Telefono" value="{{ !empty($dataContacto) ? $dataContacto[0]->telefono:old('telefono')}}">
            </div>
            <div class="form-group row">
                <input type="celular" class="form-control{{ $errors->has('celular') ? ' is-invalid':'' }}" id="celular" name="celular" placeholder="Celular" value="{{ !empty($dataContacto) ? $dataContacto[0]->celular:old('celular')}}" >
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="activo" value="1"
                        @if(!empty($dataContacto))
                            @if ($dataContacto[0]->estado == 1)
                                {{ @checked }}
                            @endif
                        @else
                            {{ @checked }}
                        @endif
                    >
                    <label class="form-check-label" for="activo">
                    Activo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="inactivo" value="0"
                        @if(!empty($dataContacto))
                            @if ($dataContacto[0]->estado == 0)
                                {{ @checked }}
                            @endif
                        @endif
                    >
                    <label class="form-check-label" for="inactivo">
                    Inactivo
                    </label>
                </div>
            </div>
            <div class="form-group row d-md-block ">
                <button type="button" class="btn btn-primary" onclick="window.location='{{ route('contacts.index') }}'">
                    Volver
                </button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <input type="hidden" id="idcontacto" name="idcontacto" value="{{ !empty($dataContacto) ? Crypt::encrypt($dataContacto[0]->idcontacto):Crypt::encrypt(0)}}" >
            </div>
        </form>
    </div>
@endsection
