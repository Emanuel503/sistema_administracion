@extends('layouts.app')

@section('content')

<h3 class="my-4">Detalles de transporte</h3>

<a class="btn btn-outline-secondary mb-4" href="{{ route('transporte.index')}}">Regresar</a>

<h5>Datos de la hoja de Control de trasnporte</h5>

<div class="mb-3">
    <label for="id_dependencia" class="col-form-label">Dependencia de transporte:</label>
    <input class="form-control" name="id_dependencia" id="id_dependencia" value="{{$transportes->dependencias->nombre}}" readonly>
</div>

<div class="mb-3">
    <label for="id_conductor" class="col-form-label">Conductor:</label>
    <input class="form-control" name="id_conductor" id="id_conductor" value="{{$transportes->conductor->nombres}} {{$transportes->conductor->apellidos}}" readonly>
</div>

<div class="mb-3">
    <label for="id_placa" class="col-form-label">Placa:</label>
    <input class="form-control" name="id_placa" id="id_placa" value="{{$transportes->vehiculo->placa}}" readonly>
</div>

<div class="mb-3">
    <label for="fecha" class="col-form-label">Fecha:</label>
    <input type="text" class="form-control" name="fecha" id="fecha" value="{{$transportes->fecha}}" readonly>
</div>

<h5>Datos de salida</h5>

<div class="mb-3">
    <label for="hora_salida" class="col-form-label">Hora salida:</label>
    <input type="time" class="form-control" name="hora_salida" id="hora_salida" value="{{$transportes->hora_salida}}" readonly>
</div>

<div class="mb-3">
    <label for="km_salida" class="col-form-label">Kilometraje salida:</label>
    <input type="text" class="form-control" name="km_salida" id="km_salida" value="{{$transportes->km_salida}}" readonly>
</div>

<div class="mb-3">
    <label for="lugar_salida" class="col-form-label">Lugar salida:</label>
    <input type="text" class="form-control" name="lugar_salida" id="lugar_salida" value="{{$transportes->lugar_s->nombre}}" readonly>
</div>

<h5>Datos de destino</h5>

<div class="mb-3">
    <label for="hora_destino" class="col-form-label">Hora destino:</label>
    <input type="time" class="form-control" name="hora_destino" id="hora_destino" value="{{$transportes->hora_destino}}" readonly>
</div>

<div class="mb-3">
    <label for="km_destino" class="col-form-label">Kilometraje destino:</label>
    <input type="text" class="form-control" name="km_destino" id="km_destino" value="{{$transportes->km_destino}}" readonly>
</div>

<div class="mb-3">
    <label for="lugar_destino" class="col-form-label">Lugar destino:</label>
    <input type="text" class="form-control" name="lugar_destino" id="lugar_destino" value="{{$transportes->lugar_d->nombre}}" readonly>
</div>

<h5>Otros datos</h5>

<div class="mb-3">
    <label for="distancia_recorrida" class="col-form-label">Distancia recorrida:</label>
    <input type="text" class="form-control" name="distancia_recorrida" id="distancia_recorrida" value="{{$transportes->distancia_recorrida}}" readonly>
</div>

<div class="mb-3">
    <label for="combustible" class="col-form-label">Combustible GLS de: <span style="font-weight: bold;">{{$transportes->tipo_combustible}}</span> </label>
    <input type="text" class="form-control" name="combustible" id="combustible" value="{{$transportes->combustible}}" readonly>
</div>

<div class="mb-3">
    <label for="pasajero" class="col-form-label">Pasajero:</label>
    <input type="text" class="form-control" name="pasajero" id="pasajero" value="{{$transportes->pasajeros->nombres}} {{$transportes->pasajeros->apellidos}}" readonly>
</div>

<form action="{{ route('transporte.destroy' , ['transporte' => $transportes->id]) }}" method="POST">
    @method('DELETE')
    @csrf
    <a class="btn btn-success" href="{{ route('transporte.edit' , ['transporte' => $transportes->id])}}">Modificar</a>
    <button type="submit" class="btn btn-danger">Eliminar</button>
</form>
@endsection