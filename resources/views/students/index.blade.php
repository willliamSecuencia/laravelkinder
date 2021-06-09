@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            {{-- <h3 class="text-dark mb-0" style="color: #c717b5;">Welcome Teacher {{ Auth::user()->name}}</h3> --}}
            <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{ route('students.add', ['id'=>Crypt::encrypt(0)]) }}">
                <strong>Nuevo estudiante</strong>
                <br>
            </a>
        </div>
        @include('students.partials.cardstudent')
    </div>
@endsection
