@extends('layouts.app')

@section('content')
    {{-- <h2 class="text-center">Evaluar Estudiante</h2>
    <div class="card-body">
        <form action="{{ route('studentsquiz.store')}}" action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <select name="estudianteevaluacion" id="estudianteevaluacion" class="form-control {{ $errors->has('estudianteevaluacion') ? ' is-invalid':'' }}" onchange="changeEstudianteEvaluacion({{$dataEstudiante}})">
                    <option value="">Seleccione un estudiante</option>
                    @foreach ($dataEstudiante as $est)
                        <option value="{{ $est->idestudiante }}">{{ $est->nombre.' '.$est->apellido }}</option>
                    @endforeach
                </select>
                @if ($errors->has('estudianteevaluacion'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('estudianteevaluacion') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group row">
                <label for="nivelestudiantelabel" class="col-sm-3 col-form-label">
                    <strong>Nivel estudiante:  </strong>
                    <label for="nivelestudiante" id="nivelestudiante"></label>
                </label>
            </div>
            <div class="form-group row">
                <textarea class="form-control{{ $errors->has('bienvenida') ? ' is-invalid':'' }}" id="bienvenida" name="bienvenida" rows="3" placeholder="Bienvenida">{{ !empty($dataItem) ? $dataItem[0]->bienvenida:old('bienvenida')}}</textarea>
                @if ($errors->has('bienvenida'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('bienvenida') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group row">
                <textarea class="form-control{{ $errors->has('concepto') ? ' is-invalid':'' }}" id="concepto" name="concepto" rows="3" placeholder="Concepto">{{ !empty($dataItem) ? $dataItem[0]->concepto:old('concepto')}}</textarea>
                @if ($errors->has('concepto'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('concepto') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group row">
                <textarea class="form-control{{ $errors->has('vocabulario') ? ' is-invalid':'' }}" id="vocabulario" name="vocabulario" rows="3" placeholder="Vocabulario">{{ !empty($dataItem) ? $dataItem[0]->vocabulario:old('vocabulario')}}</textarea>
                @if ($errors->has('vocabulario'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('vocabulario') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group row">
                <select name="mes" id="mes" class="form-control {{ $errors->has('mes') ? ' is-invalid':'' }}">
                    <option value="">Seleccione un mes</option>
                    <option value="Julio">Julio</option>
                    <option value="Diciembre">Diciembre</option>
                </select>
                {{-- Este validador es necesario para poder mostrar el mensaje -}}
                @if ($errors->has('mes'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('mes') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group row">
                <input type="number" class="form-control{{ $errors->has('ausencias') ? ' is-invalid':'' }}" id="ausencias" name="ausencias" placeholder="Ausencias" value="{{ !empty($dataEstudiante) ? $dataEstudiante[0]->ausencias:old('ausencias')}}" >
                @if ($errors->has('ausencias'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('ausencias') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group row d-md-block ">
                <button type="button" class="btn btn-primary" onclick="window.location='{{ route('students.index') }}'">
                    Volver
                </button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <input type="hidden" id="idestudiante" name="idestudiante" value="{{ !empty($dataEstudiante) ? Crypt::encrypt($dataEstudiante[0]->idevaluacionestudiante):Crypt::encrypt(0)}}" >
            </div>
        </form>
    </div> --}}
        <div class="col-md-7" style="margin-left: 0;margin-top: 19px;">
            <h3 class="text-dark mb-1">Nueva <strong>Evaluación</strong></h3>
        </div>
        {{-- <form action="{{ route('studentsquiz.store')}}" method="POST" enctype="multipart/form-data"> --}}
        <form action="#" method="POST" enctype="multipart/form-data">
            @include('studentsquiz.partials.studentinfo')
            @include('studentsquiz.partials.intromessage')
            @include('studentsquiz.partials.listcriterio')
            @include('studentsquiz.partials.vocabulary')
            @include('studentsquiz.partials.comment')
            <div class="form-group row d-md-block ">
                <button type="button" class="btn btn-primary" onclick="window.location='{{ route('studentsquiz.index') }}'">
                    Volver
                </button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                {{-- <input type="hidden" id="idcontacto" name="idcontacto" value="{{ !empty($dataContacto) ? Crypt::encrypt($dataContacto[0]->idcontacto):Crypt::encrypt(0)}}" > --}}
            </div>
        </form>
@endsection
