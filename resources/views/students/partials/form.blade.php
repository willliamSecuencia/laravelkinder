
<form action="{{ route('students.store')}}" action="#" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="col-12 col-xl-6">
            <label for="username">
                <strong>Imagen estudiante</strong>
            </label>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-4 imgUp">
                        <div class="imagePreview" style="background: url({{ !empty($dataEstudiante) ? asset('image/student/'.$dataEstudiante[0]->imagen):asset('image/student/defaultavatar.png')}}) 0 0/cover no-repeat #fff;"></div>
                        <label class="btn btn-primary">
                            Upload
                            <input type="file" class="uploadFile img" id="imagen" name="imagen" value="{{ old('imagen') }}" style="width: 0px;height: 0px;overflow: hidden;">
                        </label>
                    </div><!-- col-2 -->
                </div><!-- row -->
            </div><!-- container -->
        </div>
        <div class="col-12 col-xl-6">
            <div class="form-group row">
                <div class="col-6">
                    <select name="nivel" id="nivel" class="form-control {{ $errors->has('nivel') ? ' is-invalid':'' }}">
                        @if (!empty($dataEstudiante))

                            @foreach ($dataNivel as $nivel)
                                @if ($dataEstudiante[0]->nivel_id == $nivel->idnivel)
                                    <option value="{{ $nivel->idnivel }}">{{ $nivel->descripcion }}</option>
                                @endif
                            @endforeach

                            <option value="">Seleccione tipo de usuario</option>
                            @foreach ($dataNivel as $nivel)
                                @if ($dataEstudiante[0]->nivel_id != $nivel->idnivel)
                                    <option value="{{ $nivel->idnivel }}">{{ $nivel->descripcion }}</option>
                                @endif
                            @endforeach

                        @else

                            <option value="">Seleccione un nivel</option>
                            @foreach ($dataNivel as $nivel)
                                <option value="{{ $nivel->idnivel }}">{{ $nivel->descripcion }}</option>
                            @endforeach

                        @endif
                    </select>
                    {{-- Este validador es necesario para poder mostrar el mensaje --}}
                    @if ($errors->has('nivel'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nivel') }}</strong>
                        </span>
                    @endif

                </div>
                <div class="col-6">
                    <select name="profesores" id="profesores" class="form-control {{ $errors->has('profesores') ? ' is-invalid':'' }}">
                        @if (!empty($dataEstudiante))

                            @foreach ($dataContacto as $contacto)
                                @if ($dataEstudiante[0]->contacto_id == $contacto->idcontacto)
                                <option value="{{ $contacto->idcontacto }}">{{ $contacto->nombre." ".$contacto->apellido }}</option>
                                @endif
                            @endforeach

                            <option value="">Seleccione tipo de usuario</option>
                            @foreach ($dataContacto as $contacto)
                                @if ($dataEstudiante[0]->contacto_id != $contacto->idcontacto)
                                <option value="{{ $contacto->idcontacto }}">{{ $contacto->nombre." ".$contacto->apellido }}</option>
                                @endif
                            @endforeach

                        @else

                            <option value="">Seleccione una profesora</option>
                            @foreach ($dataContacto as $contacto)
                                <option value="{{ $contacto->idcontacto }}">{{ $contacto->nombre." ".$contacto->apellido }}</option>
                            @endforeach

                        @endif
                    </select>
                    @if ($errors->has('profesores'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('profesores') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-6" style="padding: 10px;">
                    <input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid':'' }}" id="nombre" name="nombre" placeholder="Nombres" value="{{ !empty($dataEstudiante) ? $dataEstudiante[0]->nombre:old('nombre')}}">
                    @if ($errors->has('nombre'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-6" style="padding: 10px;">
                    <input type="text" class="form-control{{ $errors->has('apellido') ? ' is-invalid':'' }}" id="apellido" name="apellido" placeholder="Apellidos" value="{{ !empty($dataEstudiante) ? $dataEstudiante[0]->apellido:old('apellido')}}" >
                    @if ($errors->has('apellido'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('apellido') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-12" style="padding: 10px;">
                    <input type="date" class="form-control{{ $errors->has('fechaNacimiento') ? ' is-invalid':'' }}" id="fechaNacimiento" name="fechaNacimiento" value="{{ !empty($dataEstudiante) ? $dataEstudiante[0]->fechaNacimiento:old('fechaNacimiento')}}">
                    @if ($errors->has('fechaNacimiento'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('fechaNacimiento') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-6" style="padding: 10px;">
                    <input type="number" class="form-control{{ $errors->has('celularmadre') ? ' is-invalid':'' }}" id="celularmadre" name="celularmadre" placeholder="Numero celular de la madre" value="{{ !empty($dataEstudiante) ? $dataEstudiante[0]->celularmadre:old('celularmadre')}}" min="10">
                </div>

                <div class="col-6" style="padding: 10px;">
                    <input type="number" class="form-control{{ $errors->has('celularpadre') ? ' is-invalid':'' }}" id="celularpadre" name="celularpadre" placeholder="Numero celular del padre" value="{{ !empty($dataEstudiante) ? $dataEstudiante[0]->celularpadre:old('celularpadre')}}" min="10" >
                </div>

                <div class="col-12" style="padding: 10px;">
                    <input type="text" class="form-control{{ $errors->has('direccion') ? ' is-invalid':'' }}" id="direccion" name="direccion" placeholder="calle 12" value="{{ !empty($dataEstudiante) ? $dataEstudiante[0]->direccion:old('direccion')}}" >
                </div>

                <div class="col-6" style="padding: 10px;">
                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="window.location='{{ route('students.index') }}'">
                        Volver
                    </button>
                </div>

                <div class="col-6" style="padding: 10px;">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Guardar</button>
                    <input type="hidden" id="idestudiante" name="idestudiante" value="{{ !empty($dataEstudiante) ? Crypt::encrypt($dataEstudiante[0]->idestudiante):Crypt::encrypt(0)}}" >
                    <input type="hidden" id="imgestudiante" name="imgestudiante" value="{{ !empty($dataEstudiante) ? $dataEstudiante[0]->imagen:''}}" >
                </div>
            </div>
        </div>
    </div>
</form>
