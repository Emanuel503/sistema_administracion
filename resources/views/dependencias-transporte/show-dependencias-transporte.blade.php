@extends('layouts.app')

@section('content')
    <h3 class="my-4">Detalles de la dependencia</h3>

    <a class="btn btn-outline-secondary mb-4" href="{{ route('dependencias-transporte.index')}}">Regresar</a>

    <div class="mb-3">
        <label for="nombre" class="col-form-label">Nombre de la dependencia:</label>
        <input class="form-control" name="nombre" id="nombre" value="{{$dependencias->nombre}}" readonly>
    </div>

    <div class="mb-3">
        <label for="fecha_registro" class="col-form-label">Fecha de registro:</label>
        <input type="text" class="form-control" name="fecha_registro" id="fecha_registro" value="{{$dependencias->created_at}}" readonly>
    </div>

    <div class="mb-3">
        <label for="fecha_modificacion" class="col-form-label">Ultima fecha de modificacion:</label>
        <input type="text" class="form-control" name="fecha_modificacion" id="fecha_modificacion" value="{{$dependencias->updated_at}}" readonly>
    </div>

    <form action="{{ route('dependencias-transporte.destroy' , ['dependencias_transporte' => $dependencias->id]) }}" method="POST">
        @method('DELETE')
        @csrf
        <a class="btn btn-success" href="{{ route('dependencias-transporte.edit' , ['dependencias_transporte' => $dependencias->id])}}">Modificar</a>
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>
@endsection