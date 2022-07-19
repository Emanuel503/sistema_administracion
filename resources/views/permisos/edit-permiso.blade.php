@php
if (Auth::user()->rol->rol != "Administrador"){
header("Location: home");
die();
}
@endphp

@extends('layouts.app')

@section('content')

<h3 class="my-4">Modificar permiso</h3>

<a class="btn btn-outline-secondary mb-4" href="{{ route('permisos.index')}}">Regresar</a>

@include('layouts.alerts')
@include('permisos.alerts')

<form action="{{ route('permisos.update', ['permiso' => $permisos->id]) }}" method="POST">
    @csrf
    @method('PATCH')

    <div class="mb-3">
        <label for="usuario" class="col-form-label">Usuario:</label>
        <select id="usuario" class="form-select" name="usuario">
            @foreach ($usuarios as $usuario )
            <option @selected($permisos->id_usuario == $usuario->id ) value="{{$usuario->id}}">{{$usuario->nombres}} {{$usuario->apellidos}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="dependencia" class="col-form-label">Dependencia:</label>
        <select id="dependencia" class="form-select" name="dependencia">
            @foreach ($lugares as $lugar )
            <option @selected($permisos->id_dependencia == $lugar->id ) value="{{$lugar->id}}">{{$lugar->nombre}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="licencia" class="col-form-label">Licencia:</label>
        <select id="licencia" class="form-select" name="licencia">
            @foreach ($tipos as $tipo)
            <option @selected($permisos->id_licencia == $tipo->id ) value="{{$tipo->id}}">{{$tipo->tipo_permiso}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="motivo" class="col-form-label">Motivo:</label>
        <select id="motivo" class="form-select" name="motivo">
            @foreach ($motivos as $motivo)
            <option @selected($permisos->id_motivo == $motivo->id ) value="{{$motivo->id}}">{{$motivo->motivo}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="usuario_autoriza" class="col-form-label">Usuario autoriza:</label>
        <select id="usuario_autoriza" class="form-select" name="usuario_autoriza">
            @foreach ($coordinadores as $coordinador)
            <option @selected($permisos->id_usuario_autoriza ==$coordinador->id_tecnico) value="{{$coordinador->id_tecnico}}">
                {{$coordinador->nombres}} {{$coordinador->apellidos}}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="usuario_adiciono" class="col-form-label">Usuario adiciono:</label>
        <input type="text" class="form-control" name="usuario_adiciono" id="usuario_adiciono" value="{{$permisos->usuarioAdi->nombres}} {{$permisos->usuarioAdi->apellidos}}" readonly>
    </div>

    <div class="mb-3">
        <label for="estado" class="col-form-label">Estado:</label>
        <input type="text" class="form-control" name="estado" id="estado" value="{{$permisos->estado->estado}}" readonly>
    </div>

    <div class="mb-3">
        <label for="fecha_entrada" class="col-form-label">Fecha entrada:</label>
        <input type="date" class="form-control" name="fecha_entrada" id="fecha_entrada" value="{{$permisos->fecha_entrada}}" required>
    </div>

    <div class="mb-3">
        <label for="hora_entrada" class="col-form-label">Hora entrada:</label>
        <input type="time" class="form-control" name="hora_entrada" id="hora_entrada" value="{{$permisos->hora_entrada}}" required>
    </div>

    <div class="mb-3">
        <label for="fecha_salida" class="col-form-label">Fecha salida:</label>
        <input type="date" class="form-control" name="fecha_salida" id="fecha_salida" value="{{$permisos->fecha_salida}}" required>
    </div>

    <div class="mb-3">
        <label for="hora_salida" class="col-form-label">Hora salida:</label>
        <input type="time" class="form-control" name="hora_salida" id="hora_salida" value="{{$permisos->hora_salida}}" required>
    </div>

    <div class="mb-3">
        <label for="dia" class="col-form-label">Día:</label>
        <input type="text" class="form-control" name="dia" id="dia" value="{{$permisos->tiempo_dia}}" readonly>
    </div>

    <div class="mb-3">
        <label for="horas" class="col-form-label">Horas:</label>
        <input type="text" class="form-control" name="horas" id="horas" value="{{$permisos->tiempo_horas}}" readonly>
    </div>

    <div class="mb-3">
        <label for="minutos" class="col-form-label">Minutos:</label>
        <input type="text" class="form-control" name="minutos" id="minutos" value="{{$permisos->tiempo_minutos}}" readonly>
    </div>

    <div class="mb-3">
        <label for="fecha_permiso" class="col-form-label">Fecha permiso:</label>
        <input type="date" class="form-control" name="fecha_permiso" id="fecha_permiso" value="{{$permisos->fecha_permiso}}" required>
    </div>

    <button type="submit" class="btn btn-success mt-4">Modificar</button>
    <a href="{{route('lugares.index')}}" class="btn btn-secondary mt-4">Cancelar</a>
</form>

<script>
    document.getElementById("id_departamento").onchange = function() {

        let selector = document.getElementById('id_departamento');
        let value = selector[selector.selectedIndex].value;

        let nodeList = document.getElementById("id_municipio").querySelectorAll("option");

        nodeList.forEach(function(option) {

            if (option.classList.contains(value)) {
                option.style.display = "block";
            } else {
                option.style.display = "none";
                document.getElementById('id_municipio').selectedIndex = -1;
            }

        });
    }
</script>

@endsection