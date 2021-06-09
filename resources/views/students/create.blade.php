@extends('layouts.app')

@section('content')
<div class="row">

        <div class="col-md-12 col-xl-12">
            <div class="card shadow mb-3">
                <div class="card-header py-3">
                    <p class="text-primary m-0 font-weight-bold">Datos Estudiante</p>
                </div>
                <div class="card-body">
                    @include('students.partials.form')
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
