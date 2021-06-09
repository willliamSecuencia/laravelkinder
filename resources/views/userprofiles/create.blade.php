@extends('layouts.app')

@section('content')
    <h2 class="text-center">Datos Perfil</h2>
    <div class="card-body">
        <form action="{{ route('userprofiles.store')}}" method="POST">
            @csrf
            @if ($updateorinsert == 0)
                <div class="form-group row">
                    <select name="contacto" id="contacto" class="form-control {{ $errors->has('contacto') ? ' is-invalid':'' }}" >
                        <option value="">Seleccione profesor</option>
                        @foreach ($dataContact as $contact)
                            <option value="{{ $contact->idcontacto }}">{{ $contact->nombre.' '.$contact->apellido}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('contacto'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('contacto') }}</strong>
                        </span>
                    @endif
                </div>
            @else
                <input type="text" class="form-control" id="contacto" name="contacto" value="{{ $dataContact[0]->nombre.' '.$dataContact[0]->apellido }}" disabled>
            @endif

            <div class="form-group">
                @if ($updateorinsert == 0)
                    @foreach ($dataMenu as $menu)
                        <div class="form-check">
                            <input type="checkbox" value="{{ $menu->idmenu }}" name="menulista[]" class="form-check-input {{ $errors->has('menulista') ? ' is-invalid':'' }}" >
                            <label class="form-check-label" for="menulistaD">
                                {{ $menu->nombremenu }}
                            </label>
                        </div>
                    @endforeach
                    @if ($errors->has('menulista'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('menulista') }}</strong>
                        </span>
                    @endif
                @else
                    @foreach ($dataMenu as $menu)

                        <div class="form-check">
                            @php $sw = false; @endphp
                            @foreach ($dataUserP as $menuaisig)
                                @if ($menuaisig->menu_id == $menu->idmenu)
                                        <input type="checkbox" value="{{$menu->idmenu}}" name="menulista[]" class="form-check-input {{ $errors->has('menulista') ? ' is-invalid':'' }}" checked>
                                        <label class="form-check-label" for="menulistaD">
                                            {{ $menu->nombremenu }}
                                        </label>

                                    @php $sw = true; @endphp
                                    @break
                                @endif

                            @endforeach
                            @if ($sw == false)

                                <input type="checkbox" value="{{ $menu->idmenu }}" name="menulista[]" class="form-check-input {{ $errors->has('menulista') ? ' is-invalid':'' }}" >
                                <label class="form-check-label" for="menulistaD">
                                    {{ $menu->nombremenu }}
                                </label>
                            @endif

                        </div>
                    @endforeach
                    @if ($errors->has('menulista'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('menulista') }}</strong>
                        </span>
                    @endif

                @endif
            </div>
            <div class="form-group row d-md-block ">
                <button type="button" class="btn btn-primary" onclick="window.location='{{ route('userprofiles.index') }}'">
                    Volver
                </button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <input type="hidden" id="idcontacto" name="idcontacto" value="{{ Crypt::encrypt($updateorinsert) }}" >
            </div>
        </form>
    </div>
@endsection

