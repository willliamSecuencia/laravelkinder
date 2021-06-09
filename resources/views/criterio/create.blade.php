@extends('layouts.app')

@section('content')
    <h2 class="text-center">Datos Criterio</h2>
    <div class="card-body">
        <form action="{{ route('criterio.store')}}" method="POST">
            @csrf
            <div class="form-group row">
                <input type="text" class="form-control{{ $errors->has('titulo') ? ' is-invalid':'' }}" id="titulo" name="titulo" placeholder="Titulo" value="{{ !empty($dataCriterio) ? $dataCriterio[0]->titulo:old('titulo')}}">
                @if ($errors->has('titulo'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('titulo') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row">
                <textarea class="form-control{{ $errors->has('descripcion') ? ' is-invalid':'' }}" id="descripcion" name="descripcion" rows="3" placeholder="Descripción">{{ !empty($dataCriterio) ? $dataCriterio[0]->descripcion:old('descripcion')}}</textarea>
                @if ($errors->has('descripcion'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('descripcion') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row d-md-block ">
                <button type="button" class="btn btn-primary" onclick="window.location='{{ route('criterio.listacriterio', ['id'=>Crypt::encrypt($dataNivel)])  }}'">
                    Volver
                </button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <input type="hidden" id="idcriterio" name="idcriterio" value="{{ !empty($dataCriterio) ? Crypt::encrypt($dataCriterio[0]->idcriterio):Crypt::encrypt(0)}}" >
                <input type="hidden" id="idn" name="idn" value="{{ Crypt::encrypt($dataNivel)}}" >
            </div>
        </form>
    </div>
@endsection
