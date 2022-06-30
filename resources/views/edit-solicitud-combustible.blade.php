@extends('layouts.app')

@section('content')
<h3 class="my-4">Modificar transporte</h3>

<a class="btn btn-outline-secondary mb-4" href="{{ route('solicitud-combustible.index')}}">Regresar</a>

@include('layouts.mensajesSolicitudCombustible')

<form action="{{ route('solicitud-combustible.update', ['solicitud_combustible' => $solicitudes->id]) }}" method="POST">
    @csrf
    @method('PATCH')
    <h5>Datos de la solicitud de combustible</h5>
    @csrf
    <div class="mb-3">
        <label for="id_destinatario" class="col-form-label">Para:</label>
        <select id="id_destinatario" class="form-select" name="id_destinatario">
            @foreach ($usuarios as $usuario)
            <option @selected($solicitudes->id_destinatario == $usuario->id ) value="{{$usuario->id}}">{{$usuario->nombres}} {{$usuario->apellidos}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="id_origen" class="col-form-label">De:</label>
        <select id="id_origen" class="form-select" name="id_origen">
            @foreach ($usuarios as $usuario)
            <option @selected($solicitudes->id_origen == $usuario->id ) value="{{$usuario->id}}">{{$usuario->nombres}} {{$usuario->apellidos}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="fecha_solicitud" class="col-form-label">Fecha solicitud:</label>
        <input type="date" class="form-control" name="fecha_solicitud" id="fecha_solicitud" value="{{$solicitudes->fecha_solicitud}}">
    </div>

    <h5>Detalles de la solicitud</h5>

    <div class="mb-3">
        <label for="id_vehiculo" class="col-form-label">Placa:</label>
        <select id="id_vehiculo" class="form-select" name="id_vehiculo">
            @foreach ($vehiculos as $vehiculo)
            <option @selected($solicitudes->id_placa == $vehiculo->id ) value="{{$vehiculo->id}}">{{$vehiculo->placa}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="id_conductor" class="col-form-label">Conductor:</label>
        <select id="id_conductor" class="form-select" name="id_conductor">
            @foreach ($usuarios as $usuario)
            @if ($usuario->motorista == 'si')
            <option @selected($solicitudes->id_conductor == $usuario->id ) value="{{$usuario->id}}">{{$usuario->nombres}} {{$usuario->apellidos}}</option>
            @endif
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="lugar_destino" class="col-form-label">Lugar destino:</label>
        <select id="lugar_destino" class="form-select" name="lugar_destino">
            @foreach ($lugares as $lugar)
            <option @selected($solicitudes->lugar_destino == $lugar->id) value="{{$lugar->id}}">{{$lugar->nombre}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="fecha_detalle" class="col-form-label">Día:</label>
        <input type="date" class="form-control" name="fecha_detalle" id="fecha_detalle" value="{{$solicitudes->fecha_detalle}}">
    </div>

    <div class="mb-3">
        <label for="hora_salida" class="col-form-label">Hora de salida:</label>
        <input type="time" class="form-control" name="hora_salida" id="hora_salida" value="{{$solicitudes->hora_salida}}">
    </div>

    <div class="mb-3">
        <label for="objetivo" class="col-form-label">Objetivo de la misión:</label>
        <input type="text" class="form-control" name="objetivo" id="objetivo" value="{{$solicitudes->objetivo}}">
    </div>

    <div class="mb-3">
        <label for="tipo_combustible" class="col-form-label">Solicita tipo de combustible:</label>
        <select name="tipo_combustible" id="tipo_combustible" class="form-select">
            <option @selected($solicitudes->tipo_combustible == 'Diesel') value="Diesel">Diesel</option>
            <option @selected($solicitudes->tipo_combustible == 'Gasolina') value="Gasolina">Gasolina</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="cantidad_combustible" class="col-form-label">Cantidad de galones autorizado:</label>
        <input type="text" class="form-control" name="cantidad_combustible" id="cantidad_combustible" value="{{$solicitudes->cantidad_combustible}}">
    </div>
    <button type="submit" class="btn btn-success mt-4">Modificar</button>
    <a href="{{route('solicitud-combustible.index')}}" class="btn btn-secondary mt-4">Cancelar</a>
</form>
@endsection