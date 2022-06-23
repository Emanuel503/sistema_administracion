@extends('layouts.app')

@section('content')

<h3 class="my-4">Modificar de la sala</h3>

<a class="btn btn-outline-secondary mb-4" href="{{ route('salas.index')}}">Regresar</a>

@include('layouts.mensajesSalas')

<form action="{{ route('salas.update', ['sala' => $salas->id]) }}" method="POST">
    @csrf
    @method('PATCH')

    <div class="mb-3">
        <label for="sala" class="col-form-label">Nombre sala:</label>
        <input type="text" class="form-control" name="sala" id="sala" value="{{$salas->sala}}">
    </div>

    <button type="submit" class="btn btn-success mt-4">Modificar</button>
    <a href="{{route('salas.index')}}" class="btn btn-secondary mt-4">Cancelar</a>
</form>

@endsection