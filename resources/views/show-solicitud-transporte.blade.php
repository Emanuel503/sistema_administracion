@extends('layouts.app')

@section('content')
    <h3 class="mb-4">Detalles de la solicitud de transporte</h3>

    <a href="{{route('solicitudes-transporte.index')}}" class="btn btn-outline-secondary mb-4">Regresar</a>

    <div class="mb-3">
        <label for="id_dependencia" class="col-form-label">Dependencia:</label>
        <input class="form-control" name="id_dependencia" value="{{$solicitudesTransportes->dependencias->nombre}}" readonly>
    </div>

    <div class="mb-3">
        <label for="id_lugar" class="col-form-label">Lugar:</label>
        <input class="form-control" name="id_dependencia" value="{{$solicitudesTransportes->lugar->nombre}}" readonly>
    </div>

    <div class="mb-3">
        <label for="fecha" class="col-form-label">Fecha del transporte:</label>
        <input type="date" class="form-control" name="fecha" id="fecha" vvalue="{{$solicitudesTransportes->fecha}}" readonly>
    </div>

    <div class="mb-3">
        <label for="hora_salida" class="col-form-label">Hora de salida:</label>
        <input type="time" class="form-control" name="hora_salida" id="hora_salida" value="{{$solicitudesTransportes->hora_salida}}" readonly>
    </div>

    <div class="mb-3">
        <label for="hora_regreso" class="col-form-label">Hora de regreso:</label>
        <input type="time" class="form-control" name="hora_regreso" id="hora_regreso" value="{{$solicitudesTransportes->hora_regreso}}" readonly>
    </div>

    <div class="mb-3">
        <label for="objetivo" class="col-form-label">Objetivo:</label>
        <textarea readonly class="form-control" name="objetivo" id="objetivo">{{$solicitudesTransportes->objetivo}}</textarea>
    </div>

    <div class="mb-3">
        <label for="observaciones" class="col-form-label">Observaciones:</label>
        <textarea readonly class="form-control" name="observaciones" id="observaciones"{{$solicitudesTransportes->observaciones}}></textarea>
    </div>

    @if(Auth::user()->rol->id == $solicitudesTransportes->usuario->id)
        @if ($solicitudesTransportes->autorizacion->id == 3)
            <form action="{{ route('solicitudes-transporte.destroy' , ['solicitudes_transporte' => $solicitudesTransportes->id]) }}" method="POST">
                @method('DELETE')
                @csrf
                <a class="btn btn-success" href="{{ route('solicitudes-transporte.edit' , ['solicitudes_transporte' => $solicitudesTransportes->id])}}">Modificar</a>
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        @endif
    @endif
@endsection