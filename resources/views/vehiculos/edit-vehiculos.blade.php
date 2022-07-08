@php
    if (Auth::user()->rol->rol != "Administrador"){
        header("Location: home");
        die();
    }
@endphp

@extends('layouts.app')

@section('content')

    <h3 class="my-4">Modificar datos vehiculo</h3>

    <a class="btn btn-outline-secondary mb-4" href="{{ route('vehiculos.index')}}">Regresar</a>

    @include('layouts.alerts')
    @include('vehiculos.alerts')

    <form action="{{ route('vehiculos.update', ['vehiculo' => $vehiculos->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="placa" class="col-form-label">Número placa:</label>
            <input type="text" class="form-control" name="placa" id="placa" value="{{$vehiculos->placa}}" required>
        </div>

        <div class="mb-3">
            <label for="marca" class="col-form-label">Marca:</label>
            <input type="text" class="form-control" name="marca" id="marca" value="{{$vehiculos->marca}}" required>
        </div>

        <div class="mb-3">
            <label for="modelo" class="col-form-label">Modelo:</label>
            <input type="text" class="form-control" name="modelo" id="modelo" value="{{$vehiculos->modelo}}" required>
        </div>

        <div class="mb-3">
            <label for="color" class="col-form-label">Color:</label>
            <input type="text" class="form-control" name="color" id="color" value="{{$vehiculos->color}}" required>
        </div>

        <div class="mb-3">
            <label for="year" class="col-form-label">Año:</label>
            <input type="year" class="form-control" name="year" id="year" value="{{$vehiculos->year}}" required>
        </div>

        <div class="mb-3">
            <label for="km" class="col-form-label">Kilometraje vehiculo:</label>
            <input type="number" min="0" class="form-control" name="km" id="km" value="{{$vehiculos->kilometraje}}" required>
        </div>

        <div class="mb-3">
            <label for="tipo_combustible" class="col-form-label">Tipo de combustible:</label>
            <select class="form-select" name="tipo_combustible" id="tipo_combustible">
                <option @selected($vehiculos->tipo_combustible == "Gasolina") value="Gasolina">Gasolina</option>
                <option @selected($vehiculos->tipo_combustible == "Diesel") value="Diesel">Diesel</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-4">Modificar</button>
        <a href="{{route('vehiculos.index')}}" class="btn btn-secondary mt-4">Cancelar</a>
    </form>
@endsection