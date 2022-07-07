@php
if (Auth::user()->rol->rol != "Administrador"){
header("Location: home");
die();
}
@endphp

@extends('layouts.app')

@section('content')

<h3 class="my-4">Modificar lugar</h3>

<a class="btn btn-outline-secondary mb-4" href="{{ route('lugares.index')}}">Regresar</a>

@include('layouts.alerts')
@include('lugares.alerts')

<form action="{{ route('lugares.update', ['lugare' => $lugares->id]) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="mb-3">
        <label for="nombre" class="col-form-label">Nombre del lugar:</label>
        <input class="form-control" name="nombre" id="nombre" value="{{$lugares->nombre}}" required>
    </div>

    <div class="mb-3">
        <label for="codigo" class="col-form-label">Codigo:</label>
        <input class="form-control" name="codigo" id="codigo" value="{{$lugares->codigo}}" required>
    </div>

    <div class="mb-3">
        <label for="id_departamento" class="col-form-label">Departamento:</label>
        <select name="id_departamento" id="id_departamento" class="form-select">
            @foreach ($departamentos as $departamento)
            <option @selected( $lugares->id_departamento == $departamento->id ) value="{{ $departamento->id}}">{{$departamento->departamento}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="id_municipio" class="col-form-label">Municipio:</label>
        <select name="id_municipio" id="id_municipio" class="form-select">
            @foreach ($municipios as $municipio)
            <option class="{{ $municipio->id_departamento}}" @selected( $lugares->id_municipio == $municipio->id ) value="{{ $municipio->id}}">{{$municipio->municipio}}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success mt-4">Modificar</button>
    <a href="{{route('lugares.index')}}" class="btn btn-secondary mt-4">Cancelar</a>
</form>

<script>
    document.getElementById("id_departamento").onchange = function() {

        let selector = document.getElementById('id_departamento');
        let value = selector[selector.selectedIndex].value;

        let nodeList = document.getElementById("id_municipio").querySelectorAll("option");

        nodeList.forEach(function(option) {

            if (option.classList.contains(value)) {
                option.style.display = "block";
            } else {
                option.style.display = "none";
                document.getElementById('id_municipio').selectedIndex = -1;
            }

        });
    }
</script>

@endsection