@extends('layouts.app')

@section('content')

<h3 class="my-4">Modificar usuario</h3>

<a class="btn btn-outline-secondary mb-4" href="{{ route('actividades.index')}}">Regresar</a>

@include('layouts.mensajesUsers')
<form action="{{ route('actividades.update', ['actividade' => $actividades->id]) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="mb-3">
        <label for="id_organizador" class="col-form-label">Organizador del evento:</label>
        <select id="id_organizador" class="form-select" name="id_organizador">
            @foreach ($organizadores as $organizador )
            <option @selected($actividades->id_organizador == $organizador->id ) value="{{$organizador->id}}">{{$organizador->nombre}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="id_coordinador" class="col-form-label">Coordinador / Asistente:</label>
        <select id="id_coordinador" class="form-select" name="id_coordinador">
            @foreach ($coordinadores as $coordinador )
            <option @selected($actividades->id_coordinador == $coordinador->id ) value="{{$coordinador->id}}">{{$coordinador->nombres}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="id_lugar" class="col-form-label">Lugar:</label>
        <select id="id_lugar" class="form-select" name="id_lugar">
            @foreach ($lugares as $lugar )
            <option @selected($actividades->id_lugar == $lugar->id ) value="{{$lugar->id}}">{{$lugar->nombre}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="nombre_actividad" class="col-form-label">Nombre de actividad:</label>
        <input type="text" class="form-control" name="nombre_actividad" id="nombre_actividad" value="{{$actividades->nombre_actividad}}">
    </div>

    <div class="mb-3">
        <label for="fecha_inicio" class="col-form-label">Fecha inicio:</label>
        <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="{{$actividades->fecha_inicio}}">
    </div>

    <div class="mb-3">
        <label for="fecha_finalizacion" class="col-form-label">Fecha finalizacion:</label>
        <input type="date" class="form-control" name="fecha_finalizacion" id="fecha_finalizacion" value="{{$actividades->fecha_finalizacion}}">
    </div>

    <div class="mb-3">
        <label for="hora_inicio" class="col-form-label">Hora inicio:</label>
        <input type="time" class="form-control" name="hora_inicio" id="hora_inicio" value="{{$actividades->hora_inicio}}">
    </div>

    <div class="mb-3">
        <label for="hora_finalizacion" class="col-form-label">Hora finalizacion:</label>
        <input type="time" class="form-control" name="hora_finalizacion" id="hora_finalizacion" value="{{$actividades->hora_finalizacion}}">
    </div>

    <div class="mb-3">
        <label for="objetivo" class="col-form-label">Objetivo:</label>
        <input type="text" class="form-control" name="objetivo" id="objetivo" value="{{$actividades->objetivo}}">
    </div>

    <div class="mb-3">
        <label for="observaciones" class="col-form-label">Observaciones:</label>
        <input type="text" class="form-control" name="observaciones" id="observaciones" value="{{$actividades->observaciones}}">
    </div>

    <div class="mb-3">
        <label for="id_estado" class="col-form-label">Estado:</label>
        <select id="id_estado" class="form-select" name="id_estado">
            @foreach ($estados as $estado )
            <option @selected($actividades->id_estado == $estado->id ) value="{{$estado->id}}">{{$estado->tipo_estado}}</option>
            @endforeach
        </select>
    </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
</form>

@endsection