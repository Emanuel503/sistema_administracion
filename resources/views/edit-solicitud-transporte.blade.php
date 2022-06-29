@extends('layouts.app')

@section('content')
    <h3 class="mb-4">Detalles de la solicitud de transporte</h3>

    <a href="{{route('solicitudes-transporte.index')}}" class="btn btn-outline-secondary mb-4">Regresar</a>

    @include('layouts.mensajesSolicitarTransporte')

    <form action="{{ route('solicitudes-transporte.update', ['solicitudes_transporte'=> $solicitudesTransportes->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="id_dependencia" class="col-form-label">Dependencia:</label>
            <select id="id_dependencia" class="form-select" name="id_dependencia">
                @if(Auth::user()->rol->id != $solicitudesTransportes->usuario->id)
                    <option value="{{$solicitudesTransportes->dependencias->id}}">{{$solicitudesTransportes->dependencias->nombre}}</option>
                @else
                    @foreach ($dependencias as $dependencia )
                        <option @selected($solicitudesTransportes->id_dependencia == $dependencia->id) value="{{$dependencia->id}}">{{$dependencia->nombre}}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="id_lugar" class="col-form-label">Lugar:</label>
            <select id="id_lugar" class="form-select" name="id_lugar">
                @if(Auth::user()->rol->id != $solicitudesTransportes->usuario->id)
                    <option value="{{$solicitudesTransportes->lugar->id}}">{{$solicitudesTransportes->lugar->nombre}}</option>
                @else
                    @foreach ($lugares as $lugar )
                        <option @selected($solicitudesTransportes->id_lugar == $lugar->id) value="{{$lugar->id}}">{{$lugar->nombre}}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha" class="col-form-label">Fecha del transporte:</label>
            <input type="date" class="form-control" name="fecha" id="fecha" value="{{$solicitudesTransportes->fecha}}" @if(Auth::user()->rol->id != $solicitudesTransportes->usuario->id) readonly @endif>
        </div>

        <div class="mb-3">
            <label for="hora_salida" class="col-form-label">Hora de salida:</label>
            <input type="time" class="form-control" name="hora_salida" id="hora_salida" value="{{$solicitudesTransportes->hora_salida}}" @if(Auth::user()->rol->id != $solicitudesTransportes->usuario->id) readonly @endif>
        </div>

        <div class="mb-3">
            <label for="hora_regreso" class="col-form-label">Hora de regreso:</label>
            <input type="time" class="form-control" name="hora_regreso" id="hora_regreso" value="{{$solicitudesTransportes->hora_regreso}}" @if(Auth::user()->rol->id != $solicitudesTransportes->usuario->id) readonly @endif>
        </div>

        <div class="mb-3">
            <label for="objetivo" class="col-form-label">Objetivo:</label>
            <textarea @if(Auth::user()->rol->id != $solicitudesTransportes->usuario->id) readonly @endif class="form-control" name="objetivo" id="objetivo">{{$solicitudesTransportes->objetivo}}</textarea>
        </div>

        <div class="mb-3">
            <label for="observaciones" class="col-form-label">Observaciones:</label>
            <textarea @if(Auth::user()->rol->id != $solicitudesTransportes->usuario->id) readonly @endif class="form-control" name="observaciones" id="observaciones">{{$solicitudesTransportes->observaciones}}</textarea>
        </div>

        <div class="mb-3">
            <label for="id_autorizacion_vehiculo" class="col-form-label">Autorizacion:</label>
            <select id="id_autorizacion_vehiculo" class="form-select" name="id_autorizacion">
                @if(Auth::user()->rol->id != "1")
                    <option value="{{$solicitudesTransportes->autorizacion->id}}">{{$solicitudesTransportes->autorizacion->autorizacion}}</option>
                @else
                    @foreach ($autorizaciones as $autorizacion )
                        <option @selected($solicitudesTransportes->id_autorizacion == $autorizacion->id) value="{{$autorizacion->id}}">{{$autorizacion->autorizacion}}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div id="divVehiculo" class="mb-3" @if ($solicitudesTransportes->autorizacion->id != 1) hidden @endif>
            <label for="id_vehiculo" class="col-form-label">Vehiculo:</label>
            <select id="id_vehiculo" class="form-select" name="id_vehiculo">
                @if(Auth::user()->rol->id != "1")
                    <option value="{{$solicitudesTransportes->id_vehiculo}}">{{$solicitudesTransportes->vehiculos}}</option>
                @else
                    @foreach ($vehiculos as $vehiculo )
                        <option @selected($solicitudesTransportes->id_vehiculo == $vehiculo->id) value="{{$vehiculo->id}}">{{$vehiculo->placa}}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div id="divMotorista" class="mb-3" @if ($solicitudesTransportes->autorizacion->id != 1) hidden @endif >
            <label for="id_motorista" class="col-form-label">Motorista:</label>
            <select id="id_motorista" class="form-select" name="id_motorista">
                @if(Auth::user()->rol->id != "1")
                    <option value="{{$solicitudesTransportes->id_motorista}}">{{$solicitudesTransportes->motorista}}</option>
                @else
                    @foreach ($usuarios as $usuario)
                        @if ($usuario->motorista == "si")
                            <option @selected($solicitudesTransportes->id_motorista == $usuario->id) value="{{$usuario->id}}">{{$usuario->nombres}} {{$usuario->apellidos}}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-4">Modificar</button>
        <a href="{{route('solicitudes-transporte.index')}}" class="btn btn-secondary  mt-4">Cancelar</a>
    </form>
@endsection