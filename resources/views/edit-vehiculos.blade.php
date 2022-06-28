@extends('layouts.app')

@section('content')

<h3 class="my-4">Modificar de la placa</h3>

<a class="btn btn-outline-secondary mb-4" href="{{ route('placas-vehiculos.index')}}">Regresar</a>

@include('layouts.mensajesSala')

<form action="{{ route('placas-vehiculos.update', ['placas_vehiculo' => $placas->id]) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="mb-3">
        <label for="placa" class="col-form-label">Nombre placa:</label>
        <input type="text" class="form-control" name="placa" id="placa" value="{{$placas->placa}}">
    </div>
    <button type="submit" class="btn btn-success mt-4">Modificar</button>
    <a href="{{route('placas-vehiculos.index')}}" class="btn btn-secondary mt-4">Cancelar</a>
</form>
@endsection