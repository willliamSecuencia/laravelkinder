<div class="col-md-12 col-xl-12" style="margin-top: 6px;">
    <div class="card shadow mb-3">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Información del estudiante</p>
        </div>
        <div class="card-body">
                <div class="form-row">
                    <div class="col-12 col-xl-6">
                        <label for="username">
                            <strong>Seleccionar estudiante</strong>
                            <br>
                        </label>
                        <select class="form-control" tabindex="-98">
                            <optgroup label="Nivel 1">
                                @foreach ($dataEstudiante as $est)
                                    @if ($est->nivel_id == 1)
                                        <option value="{{ $est->idestudiante }}">{{ $est->nombre.' '.$est->apellido }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                            <div class="dropdown-divider"></div>
                            <optgroup label="Nivel 2">
                                @foreach ($dataEstudiante as $est)
                                    @if ($est->nivel_id == 2)
                                        <option value="{{ $est->idestudiante }}">{{ $est->nombre.' '.$est->apellido }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                            <div class="dropdown-divider"></div>
                            <optgroup label="Nivel 3">
                                @foreach ($dataEstudiante as $est)
                                    @if ($est->nivel_id == 3)
                                        <option value="{{ $est->idestudiante }}">{{ $est->nombre.' '.$est->apellido }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    <div class="col-12 col-xl-6">
                        <label for="username">
                            <strong>Año</strong>
                            <br>
                        </label>
                        <input class="form-control" type="number" value="2021" max="2080" min="2021">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12 col-xl-6">
                        <div class="form-group">
                            <label for="first_name">
                                <strong>Ausencias</strong>
                            </label>
                            <input class="form-control" type="number" value="0" max="100" min="0">
                        </div>
                    </div>
                    <div class="col-12 col-xl-6">
                        <label for="username">
                            <strong>Mes evaluación</strong>
                            <br>
                        </label>

                        <select class="form-control" tabindex="-98">
                            <option value="13">July</option>
                            <option value="14">December</option>
                        </select>
                    </div>
            </div>
        </div>
    </div>
</div>
