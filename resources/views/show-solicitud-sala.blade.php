@extends('layouts.app')

@section('content')
    <h3 class="mb-4">Modificar solicitud de sala</h3>

    <a href="{{route('solicitudes-sala.index')}}" class="btn btn-outline-secondary mb-4">Regresar</a>

    @include('layouts.mensajesSalas')

    <form action="{{ route('solicitudes-sala.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_sala" class="col-form-label">Sala:</label>
            <select id="id_sala" class="form-select" name="id_sala">
                @foreach ($salas as $sala )
                    <option @selected($solicitudesSala->id_sala == $sala->id) value="{{$sala->id}}">{{$sala->sala}}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="fecha" class="col-form-label">Fecha de utilizacion:</label>
            <input type="date" class="form-control" name="fecha" id="fecha" value="{{ $solicitudesSala->fecha }}">
        </div>

        <div class="mb-3">
            <label for="hora_inicio" class="col-form-label">Hora de inicio:</label>
            <input type="time" class="form-control" name="hora_inicio" id="hora_inicio" value="{{ $solicitudesSala->hora_inicio }}">
        </div>

        <div class="mb-3">
            <label for="hora_finalizacion" class="col-form-label">Hora de finalizacion:</label>
            <input type="time" class="form-control" name="hora_finalizacion" id="hora_finalizacion" value="{{ $solicitudesSala->hora_finalizacion }}">
        </div>

        <div class="mb-3">
            <label for="actividad" class="col-form-label">Descripcion de la actividad:</label>
            <input type="text" class="form-control" name="actividad" id="actividad" value="{{ $solicitudesSala->actividad }}">
        </div>

        <div class="mb-3">
            <label for="observaciones" class="col-form-label">Observaciones:</label>
            <input type="text" class="form-control" name="observaciones" id="observaciones" value="{{ $solicitudesSala->observaciones }}">
        </div>
        <a href="{{route('solicitudes-sala.index')}}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>    
@endsection