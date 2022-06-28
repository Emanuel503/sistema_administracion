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
        <label for="id_conductor" class="col-form-label">Conductor:</label>
        <select id="id_conductor" class="form-select" name="id_conductor">
            @foreach ($usuarios as $usuario )
            @if ($usuario->motorista == 'si')
            <option @selected($transportes->id_conductor == $usuario->id ) value="{{$usuario->id}}">{{$usuario->nombres}} {{$usuario->apellidos}}</option>
            @endif
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="id_placa" class="col-form-label">Placa:</label>
        <select id="id_placa" class="form-select" name="id_placa">
            @foreach ($placas as $placa )
            <option @selected($transportes->id_placa == $placa->id ) value="{{$placa->id}}">{{$placa->placa}}</option>
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
            <option @selected($transportes->lugar_salida == $lugar->id ) value="{{$lugar->id}}">{{$lugar->nombre}}</option>
            @endif
            @endforeach
        </select>
    </div>

    <h5>Datos de destino</h5>

    <div class="mb-3">
        <label for="hora_destino" class="col-form-label">Hora destino:</label>
        <input type="time" class="form-control" name="hora_destino" id="hora_destino" value="{{$transportes->hora_destino}}">
    </div>

    <div class="mb-3">
        <label for="km_destino" class="col-form-label">Kilometraje destino:</label>
        <input type="text" class="form-control" name="km_destino" id="km_destino" value="{{$transportes->km_destino}}">
    </div>

    <div class="mb-3">
        <label for="lugar_destino" class="col-form-label">Lugar destino:</label>
        <select id="lugar_destino" class="form-select" name="lugar_destino" value="{{$transportes->lugar_destino}}">
            @foreach ($lugares as $lugar )
            <option value="{{$lugar->id}}">{{$lugar->nombre}}</option>
            @endforeach
        </select>
    </div>

    <h5>Otros datos</h5>

    <div class="mb-3">
        <label for="distancia_recorrida" class="col-form-label">Distancia recorrida:</label>
        <input type="text" class="form-control" name="distancia_recorrida" id="distancia_recorrida" value="{{$transportes->distancia_recorrida}}">
    </div>

    <div class="mb-3">
        <label for="combustible" class="col-form-label">Combustible GLS de</label>

        <select id="pasajero" class="form-select" name="pasajero">

            <option @selected($transportes->pasajero == $usuario->id ) value="{{$usuario->id}}">{{$usuario->nombres}} {{$usuario->apellidos}}</option>

        </select>

        <select name="tipo_combustible" id="tipo_combustible" class="form-select">
            <option value="Salud">Salud</option>
            <option value="Otros">Otros</option>
        </select>
        <input type="text" class="form-control" name="combustible" id="combustible" value="{{$transportes->combustible}}">
    </div>

    <div class="mb-3">
        <label for="pasajero" class="col-form-label">Pasajero:</label>
        <select id="pasajero" class="form-select" name="pasajero">
            @foreach ($usuarios as $usuario )
            <option @selected($transportes->pasajero == $usuario->id ) value="{{$usuario->id}}">{{$usuario->nombres}} {{$usuario->apellidos}}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success mt-4">Modificar</button>
    <a href="{{route('actividades.index')}}" class="btn btn-secondary mt-4">Cancelar</a>
</form>
@endsection