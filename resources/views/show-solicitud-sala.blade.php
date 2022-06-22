@extends('layouts.app')

@section('content')
    <h3 class="mb-4">Modificar solicitud de sala</h3>

    <a href="{{route('solicitudes-sala.index')}}" class="btn btn-outline-secondary mb-4">Regresar</a>

    @include('layouts.mensajesSalas')

    <form action="{{ route('solicitudes-sala.update', ['solicitudes_sala' => $solicitudesSala->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="id_sala" class="col-form-label">Sala:</label>
            <select id="id_sala" class="form-select" name="id_sala">
                @if(Auth::user()->rol->id == "1")
                    <option value="{{$solicitudesSala->sala->id}}">{{$solicitudesSala->sala->sala}}</option>
                @else
                    @foreach ($salas as $sala )
                        <option @selected($solicitudesSala->id_sala == $sala->id) value="{{$sala->id}}">{{$sala->sala}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        
        <div class="mb-3">
            <label for="fecha" class="col-form-label">Fecha de utilizacion:</label>
            <input type="date" class="form-control" name="fecha" id="fecha" value="{{ $solicitudesSala->fecha }}" @if(Auth::user()->rol->id == "1") readonly @endif>
        </div>

        <div class="mb-3">
            <label for="hora_inicio" class="col-form-label">Hora de inicio:</label>
            <input type="time" class="form-control" name="hora_inicio" id="hora_inicio" value="{{ $solicitudesSala->hora_inicio }}" @if(Auth::user()->rol->id == "1") readonly @endif>
        </div>

        <div class="mb-3">
            <label for="hora_finalizacion" class="col-form-label">Hora de finalizacion:</label>
            <input type="time" class="form-control" name="hora_finalizacion" id="hora_finalizacion" value="{{ $solicitudesSala->hora_finalizacion }}" @if(Auth::user()->rol->id == "1") readonly @endif>
        </div>

        <div class="mb-3">
            <label for="actividad" class="col-form-label">Descripcion de la actividad:</label>
            <textarea class="form-control" name="actividad" id="actividad" @if(Auth::user()->rol->id == "1") readonly @endif>{{$solicitudesSala->actividad}}</textarea>
        </div>

        <div class="mb-3">
            <label for="observaciones" class="col-form-label">Observaciones:</label>
            <textarea class="form-control" name="observaciones" id="observaciones" @if(Auth::user()->rol->id == "1") readonly @endif>{{$solicitudesSala->observaciones}}</textarea>
        </div>

        <div class="mb-3">
            <label for="id_autorizacion" class="col-form-label">Autorizacion:</label>
            <select id="id_autorizacion" class="form-select" name="id_autorizacion">
                @if(Auth::user()->rol->id != "1")
                    <option value="{{$solicitudesSala->autorizacion->id}}">{{$solicitudesSala->autorizacion->autorizacion}}</option>
                @else
                    @foreach ($autorizaciones as $autorizacion )
                        <option @selected($solicitudesSala->id_autorizacion == $autorizacion->id) value="{{$autorizacion->id}}">{{$autorizacion->autorizacion}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        
        <button type="submit" class="btn btn-success mt-4">Modificar</button>
        <a href="{{route('solicitudes-sala.index')}}" class="btn btn-secondary  mt-4">Cancelar</a>
        
    </form>    
@endsection