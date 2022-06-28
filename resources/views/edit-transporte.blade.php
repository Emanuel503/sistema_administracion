@extends('layouts.app')

@section('content')
<h3 class="my-4">Modificar transporte</h3>

<a class="btn btn-outline-secondary mb-4" href="{{ route('transporte.index')}}">Regresar</a>

@include('layouts.mensajesActividades')

<form action="{{ route('transporte.update', ['transporte' => $transportes->id]) }}" method="POST">
    @csrf
    @method('PATCH')
    <h5>Datos de la hoja de Control de transporte</h5>
    @csrf
    <div class="mb-3">
        <label for="id_dependencia" class="col-form-label">Dependencia de transporte:</label>
        <select id="id_dependencia" class="form-select" name="id_dependencia">
            @foreach ($dependencias as $dependencia )
            <option @selected($transportes->id_dependencia == $dependencia->id ) value="{{$dependencia->id}}">{{$dependencia->nombre}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="id_coductor" class="col-form-label">Conductor:</label>
        <select id="id_coductor" class="form-select" name="id_coductor">
            @foreach ($usuarios as $usuario )
            @if ($usuario->motorista == 'si')
            <option @selected($transportes->id_conductor == $usuario->id ) value="{{$usuario->id}}">{{$usuario->nombre}}</option>
            @endif
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="id_placa" class="col-form-label">Placa:</label>
        <select id="id_placa" class="form-select" name="id_placa">
            @foreach ($placas as $placa )
            <option @selected($transportes->id_placa == $placa->id ) value="{{$placa->id}}">{{$placa->nombre}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="fecha" class="col-form-label">Fecha:</label>
        <input type="date" class="form-control" name="fecha" id="fecha" value="{{$transportes->fecha}}">
    </div>

    <h5>Datos de salida</h5>

    <div class="mb-3">
        <label for="hora_salida" class="col-form-label">Hora salida:</label>
        <input type="time" class="form-control" name="hora_salida" id="hora_salida" value="{{$transportes->hora_salida}}">
    </div>

    <div class="mb-3">
        <label for="km_salida" class="col-form-label">Kilometraje salida:</label>
        <input type="text" class="form-control" name="km_salida" id="km_salida" value="{{$transportes->km_salida}}">
    </div>

    <div class="mb-3">
        <label for="lugar_salida" class="col-form-label">Lugar salida:</label>
        <select id="lugar_salida" class="form-select" name="lugar_salida" value="{{$transportes->lugar_salida}}">
            @foreach ($lugares as $lugar )
            @if ($lugar->id == 3)
            <option @selected($transportes->id_placa == $placa->id ) value="{{$placa->id}}">{{$placa->nombre}}</option>
            @endif
            @endforeach
        </select>
    </div>

    <h5>Datos de destino</h5>

    <div class="mb-3">
        <label for="hora_destino" class="col-form-label">Hora destino:</label>
        <input type="time" class="form-control" name="hora_destino" id="hora_destino">
    </div>

    <div class="mb-3">
        <label for="km_destino" class="col-form-label">Kilometraje destino:</label>
        <input type="text" class="form-control" name="km_destino" id="km_destino">
    </div>

    <div class="mb-3">
        <label for="lugar_destino" class="col-form-label">Lugar destino:</label>
        <select id="lugar_destino" class="form-select" name="lugar_destino">
            @foreach ($lugares as $lugar )
            <option value="{{$lugar->id}}">{{$lugar->nombre}}</option>
            @endforeach
        </select>
    </div>

    <h5>Otros datos</h5>

    <div class="mb-3">
        <label for="distancia_recorrida" class="col-form-label">Distancia recorrida:</label>
        <input type="text" class="form-control" name="distancia_recorrida" id="distancia_recorrida">
    </div>

    <div class="mb-3">
        <label for="combustible" class="col-form-label">Combustible GLS de</label>
        <select name="tipo_combustible" id="tipo_combustible" class="form-select">
            <option value="Salud">Salud</option>
            <option value="Otros">Otros</option>
        </select>
        <input type="text" class="form-control" name="combustible" id="combustible">
    </div>

    <div class="mb-3">
        <label for="pasajero" class="col-form-label">Pasajero:</label>
        <select id="pasajero" class="form-select" name="pasajero">
            @foreach ($usuarios as $usuario )
            <option value="{{$usuario->id}}">{{$usuario->nombres}} {{$usuario->apellidos}}</option>
            @endforeach
        </select>
    </div>

    -----
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
        <label for="title" class="col-form-label">Nombre de actividad:</label>
        <input type="text" class="form-control" name="title" id="title" value="{{$actividades->title}}">
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
        <textarea class="form-control" name="objetivo" id="objetivo">{{$actividades->objetivo}}</textarea>
    </div>

    <div class="mb-3">
        <label for="observaciones" class="col-form-label">Observaciones:</label>
        <textarea class="form-control" name="observaciones" id="observaciones">{{$actividades->observaciones}}</textarea>
    </div>

    <div class="mb-3">
        <label for="id_estado" class="col-form-label">Estado:</label>
        <select id="id_estado" class="form-select" name="id_estado">

            @if(Auth::user()->rol->id != "1")
            <option value="{{$actividades->id_estado}}">{{$actividades->estado->tipo_estado}}</option>
            @else
            @foreach ($estados as $estado )
            <option @selected($actividades->id_estado == $estado->id ) value="{{$estado->id}}">{{$estado->tipo_estado}}</option>
            @endforeach
            @endif
        </select>
    </div>

    <button type="submit" class="btn btn-success mt-4">Modificar</button>
    <a href="{{route('actividades.index')}}" class="btn btn-secondary mt-4">Cancelar</a>
</form>
@endsection