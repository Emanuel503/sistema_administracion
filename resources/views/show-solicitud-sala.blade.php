@extends('layouts.app')

@section('content')
    <h3 class="mb-4">Detalles de la solicitud de sala</h3>

    <a href="{{route('solicitudes-sala.index')}}" class="btn btn-outline-secondary mb-4">Regresar</a>

    <div class="mb-3">
        <label for="id_sala" class="col-form-label">Sala:</label>
        <input type="text" class="form-control" name="id_sala" id="id_sala" value="{{ $solicitudesSala->sala->sala}}" readonly>
    </div>
    
    <div class="mb-3">
        <label for="fecha" class="col-form-label">Fecha de utilizacion:</label>
        <input type="date" class="form-control" name="fecha" id="fecha" value="{{ $solicitudesSala->fecha }}" readonly>
    </div>

    <div class="mb-3">
        <label for="hora_inicio" class="col-form-label">Hora de inicio:</label>
        <input type="time" class="form-control" name="hora_inicio" id="hora_inicio" value="{{ $solicitudesSala->hora_inicio }}" readonly>
    </div>

    <div class="mb-3">
        <label for="hora_finalizacion" class="col-form-label">Hora de finalizacion:</label>
        <input type="time" class="form-control" name="hora_finalizacion" id="hora_finalizacion" value="{{ $solicitudesSala->hora_finalizacion }}" readonly>
    </div>

    <div class="mb-3">
        <label for="actividad" class="col-form-label">Descripcion de la actividad:</label>
        <textarea class="form-control" name="actividad" id="actividad" readonly>{{$solicitudesSala->actividad}}</textarea>
    </div>

    <div class="mb-3">
        <label for="observaciones" class="col-form-label">Observaciones:</label>
        <textarea class="form-control" name="observaciones" id="observaciones" readonly>{{$solicitudesSala->observaciones}}</textarea>
    </div>

    <div class="mb-3">
        <label for="id_autorizacion" class="col-form-label">Autorizacion:</label>
        <input type="text" class="form-control" name="id_autorizacion" id="id_autorizacion" value="{{ $solicitudesSala->autorizacion->autorizacion}}" readonly>
    </div>

    @if(Auth::user()->rol->id == $solicitudesSala->usuario->id)
        @if ($solicitudesSala->autorizacion->id == 3)
            <form action="{{ route('solicitudes-sala.destroy' , ['solicitudes_sala' => $solicitudesSala->id]) }}" method="POST">
                @method('DELETE')
                @csrf
                <a class="btn btn-success" href="{{ route('solicitudes-sala.edit' , ['solicitudes_sala' => $solicitudesSala->id])}}">Modificar</a>
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        @endif
    @endif
@endsection