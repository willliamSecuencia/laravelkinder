@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">


        <div class="col-md-9 col-lg-12 col-xl-10">
            <div class="card shadow-lg o-hidden border-0 my-5">
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-flex" style="background-image: url('{{ asset('image/childs.jpg') }}">
                        <header></header>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                                <div class="text-center" style="margin-bottom: 21px;"><img src="{{ asset('image/PeekaBooLogo.png') }}" style="width: 123px;"></div>
                                <div class="text-center">
                                    <h4 class="text-dark mb-4">{{ __('Restablecer contraseña') }}</h4>
                                </div>


                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}" class="user">
                                @csrf

                                <div class="form-group">
                                    <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Ingrese su email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block text-white btn-user">
                                        {{ __('Enviar enlace de restablecimiento de contraseña') }}
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
