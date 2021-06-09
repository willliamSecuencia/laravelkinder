@extends('layouts.app')

@section('content')
        <div class="row">
            @if (!empty($dataNivel))
                @foreach ($dataNivel as $dataN)

                    <div class="col-sm-4" style="margin-top: 9px;">
                      <div class="card text-center" style="width: 18rem;">
                        <div class="card-body">
                          <p class="card-text">{{ $dataN->descripcion }}</p>
                          <a href="{{ route('criterio.listacriterio', ['id'=>Crypt::encrypt($dataN->idnivel)]) }}" class="btn btn-primary">Ver listado</a>
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
@endsection
