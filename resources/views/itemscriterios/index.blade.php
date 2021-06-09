@extends('layouts.app')

@section('content')
        <div class="row">
            @if (!empty($dataCriterio))
                @foreach ($dataCriterio as $dataCr)

                    <div class="col-sm-4 py-2" style="margin-top: 9px;">
                        <div class="card h-100" style="width: 18rem;">
                            <div class="card-header bg-transparent text-center">
                                <strong> {{ $dataCr->titulo.' - '.$dataCr->nivel }}</strong>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $dataCr->descripcion }}</p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <a href="{{ route('itemcriterio.listitem', ['id'=>Crypt::encrypt($dataCr->idcriterio)]) }}" class="btn btn-primary">Ver listado</a>
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
