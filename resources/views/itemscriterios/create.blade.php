@extends('layouts.app')

@section('content')
    <h2 class="text-center">Dato Item - <strong>{{ $nombreCN[0]->criterio }} - {{ $nombreCN[0]->nivel }}</strong></h2>
    <div class="card-body">
        <form action="{{ route('itemcriterio.store')}}" method="POST">
            @csrf
            <div class="form-group row">
                <textarea class="form-control{{ $errors->has('descripcion') ? ' is-invalid':'' }}" id="descripcion" name="descripcion" rows="3" placeholder="Descripción">{{ !empty($dataItem) ? $dataItem[0]->descripcion:old('descripcion')}}</textarea>
                @if ($errors->has('descripcion'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('descripcion') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row d-md-block ">
                <button type="button" class="btn btn-primary" onclick="window.location='{{ route('itemcriterio.listitem', ['id'=>Crypt::encrypt($idcriterio)])  }}'">
                    Volver
                </button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <input type="hidden" id="iditem" name="iditem" value="{{ !empty($dataItem) ? Crypt::encrypt($dataItem[0]->idlistacriterio):Crypt::encrypt(0)}}" >
                <input type="hidden" id="idct" name="idct" value="{{ Crypt::encrypt($idcriterio)}}" >
            </div>
        </form>
    </div>
@endsection
