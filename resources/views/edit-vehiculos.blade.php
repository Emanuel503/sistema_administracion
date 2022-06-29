@extends('layouts.app')

@section('content')

<h3 class="my-4">Modificar datos vehiculo</h3>

<a class="btn btn-outline-secondary mb-4" href="{{ route('vehiculos.index')}}">Regresar</a>

@include('layouts.mensajesVehiculos')

<form action="{{ route('vehiculos.update', ['vehiculo' => $vehiculos->id]) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="mb-3">
        <label for="placa" class="col-form-label">Número placa:</label>
        <input type="text" class="form-control" name="placa" id="placa" value="{{$vehiculos->placa}}">
    </div>

    <div class="mb-3">
        <label for="km" class="col-form-label">Kilometraje vehiculo:</label>
        <input type="text" class="form-control" name="km" id="km" value="{{$vehiculos->kilometraje}}">
    </div>

    <button type="submit" class="btn btn-success mt-4">Modificar</button>
    <a href="{{route('vehiculos.index')}}" class="btn btn-secondary mt-4">Cancelar</a>
</form>
@endsection