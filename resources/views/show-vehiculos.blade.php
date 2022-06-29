@extends('layouts.app')

@section('content')
<h3 class="my-4">Detalles de la placa</h3>

<a class="btn btn-outline-secondary mb-4" href="{{ route('vehiculos.index')}}">Regresar</a>

<div class="mb-3">
    <label for="placa" class="col-form-label">Número de placa:</label>
    <input class="form-control" name="placa" id="placa" value="{{$vehiculos->placa}}" readonly>
</div>

<div class="mb-3">
    <label for="km" class="col-form-label">Kilometraje del vehiculo:</label>
    <input class="form-control" name="km" id="km" value="{{$vehiculos->kilometraje}}" readonly>
</div>

<form action="{{ route('vehiculos.destroy' , ['vehiculo' => $vehiculos->id]) }}" method="POST">
    @method('DELETE')
    @csrf
    <a class="btn btn-success" href="{{ route('vehiculos.edit' , ['vehiculo' => $vehiculos->id])}}">Modificar</a>
    <button type="submit" class="btn btn-danger">Eliminar</button>
</form>
@endsection