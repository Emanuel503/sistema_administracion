@php
if (Auth::user()->rol->rol != "Administrador"){
header("Location: home");
die();
}
@endphp

@extends('layouts.app')

@section('content')

<h3 class="my-4">Modificar coordinador</h3>

<a class="btn btn-outline-secondary mb-4" href="{{ route('coordinadores.index')}}">Regresar</a>

@include('layouts.alerts')

<form action="{{ route('coordinadores.update', ['coordinadore' => $coordinadores->id]) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="mb-3">
        <label for="usuario" class="col-form-label">Técnico usuario:</label>
        <select id="usuario" class="form-select" name="usuario">
            @foreach ($usuarios as $usuario )
            <option @selected($coordinadores->id_tecnico == $usuario->id ) value="{{$usuario->id}}">{{$usuario->nombres}} {{$usuario->apellidos}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="tipo_coordinacion" class="col-form-label">Tipo de coordinación:</label>
        <select id="tipo_coordinacion" class="form-select" name="tipo_coordinacion">
            @foreach ($coordinaciones as $coordinacion )
            <option @selected($coordinadores->id_coordinacion == $coordinacion->id ) value="{{$coordinacion->id}}">{{$coordinacion->tipo_coordinacion}}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success mt-4">Modificar</button>
    <a href="{{route('coordinadores.index')}}" class="btn btn-secondary mt-4">Cancelar</a>
</form>
@endsection