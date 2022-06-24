@extends('layouts.app')

@section('content')
    <h3 class="my-4">Detalles de la Sala</h3>

    <a class="btn btn-outline-secondary mb-4" href="{{ route('salas.index')}}">Regresar</a>

    <div class="mb-3">
        <label for="sala" class="col-form-label">Nombre de la sala:</label>
        <input class="form-control" name="sala" id="sala" value="{{$salas->sala}}" readonly>
    </div>
@endsection