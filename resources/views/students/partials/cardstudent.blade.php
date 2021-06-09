<div class="row">
    @if (!empty($dataEstudiante))
        @foreach ($dataEstudiante as $dataE)
            <div class="col-md-6 col-xl-3" style="margin-top: 9px;">
                <div class="card h-100 shadow mb-4">
                    <div class="card-header text-center py-3">
                        <h6 class="text-primary font-weight-bold m-0">{{ $dataE->nombre.' '.$dataE->apellido }}</h6>
                    </div>
                    <div class="d-flex d-xl-flex justify-content-center justify-content-xl-center" style="text-align: center;margin-top: 17px;">
                        <img class="rounded-circle mb-3 mt-4" src="{{ asset('image/student/'.$dataE->imagen) }}" width="160" height="160" >
                    </div>
                    <div class="card-body" style="text-align: center;">
                        <a class="btn btn-primary" role="button" href="{{ route('students.add', ['id'=>Crypt::encrypt($dataE->idestudiante)]) }}"><i class="fas fa-edit"></i></a>
                        {{-- <a class="btn btn-primary" role="button" href="https://lacasadealan.com/peekpdf/Boletin%202021%20december.pdf" target="_blank">PDF Export</a> --}}
                        <a href="#" class="btn btn-primary" onclick="deleteConfirm('deleteEstudiante{{$dataE->idestudiante}}')" title="Eliminar">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                        <form id="deleteEstudiante{{$dataE->idestudiante}}" action="{{ route('students.delete', [Crypt::encrypt($dataE->idestudiante)]) }}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                        </form>
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
