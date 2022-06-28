@extends('layouts.app')

@section('content')

    <h3 class="my-4">Modificar dependencia</h3>

    <a class="btn btn-outline-secondary mb-4" href="{{ route('dependencias-transporte.index')}}">Regresar</a>

    @include('layouts.mensajesDependenciasTransporte')

    <form action="{{ route('dependencias-transporte.update', ['dependencias_transporte' => $dependencias->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="nombre" class="col-form-label">Nombre dependencia:</label>
            <input class="form-control" name="nombre" id="nombre" value="{{$dependencias->nombre}}">
        </div>
    
        <button type="submit" class="btn btn-success mt-4">Modificar</button>
        <a href="{{route('dependencias-transporte.index')}}" class="btn btn-secondary mt-4">Cancelar</a>
    </form>
@endsection