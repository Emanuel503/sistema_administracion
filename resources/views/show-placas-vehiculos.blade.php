@extends('layouts.app')

@section('content')
<h3 class="my-4">Detalles de la placa</h3>

<a class="btn btn-outline-secondary mb-4" href="{{ route('placas-vehiculos.index')}}">Regresar</a>

<div class="mb-3">
    <label for="placa" class="col-form-label">Número de placa:</label>
    <input class="form-control" name="placa" id="placa" value="{{$placas->placa}}" readonly>
</div>

<form action="{{ route('placas-vehiculos.destroy' , ['placas_vehiculo' => $placas->id]) }}" method="POST">
    @method('DELETE')
    @csrf
    <a class="btn btn-success" href="{{ route('placas-vehiculos.edit' , ['placas_vehiculo' => $placas->id])}}">Modificar</a>
    <button type="submit" class="btn btn-danger">Eliminar</button>
</form>
@endsection