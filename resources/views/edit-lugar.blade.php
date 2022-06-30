@extends('layouts.app')

@section('content')

<h3 class="my-4">Modificar lugar</h3>

<a class="btn btn-outline-secondary mb-4" href="{{ route('lugares.index')}}">Regresar</a>

@include('layouts.mensajesLugares')

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
    <button type="submit" class="btn btn-success mt-4">Modificar</button>
    <a href="{{route('lugares.index')}}" class="btn btn-secondary mt-4">Cancelar</a>
</form>
@endsection