@extends('layouts.app')

@section('content')
    <h3 class="my-4">Detalles de la lugares</h3>

    <a class="btn btn-outline-secondary mb-4" href="{{ route('lugares.index')}}">Regresar</a>

    <div class="mb-3">
        <label for="nombre" class="col-form-label">Nombre del lugar:</label>
        <input class="form-control" name="nombre" id="nombre" value="{{$lugares->nombre}}" readonly>
    </div>

    <div class="mb-3">
        <label for="codigo" class="col-form-label">Codigo:</label>
        <input class="form-control" name="codigo" id="codigo" value="{{$lugares->codigo}}" readonly>
    </div>

    <form action="{{ route('lugares.destroy' , ['lugare' => $lugares->id]) }}" method="POST">
        @method('DELETE')
        @csrf
        <a class="btn btn-success btn-sm" href="{{ route('lugares.edit' , ['lugare' => $lugares->id])}}">Modificar</a>
        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
    </form>
@endsection