@extends('layouts.app')

@section('content')
    <h3 class="mb-4">Solicitudes de salas</h3>

    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Solicitar sala</button>

    @include('layouts.mensajesSalas')

    @if (sizeof($solicitudesSalas) > 0)
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr class="table-dark">
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Sala</th>
                    <th>Actividad</th>
                    <th>Hora inicio</th>
                    <th>Hora finalizacion</th>
                    <th>Usuario solicitante</th>
                    <th>Autorizacion</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($solicitudesSalas as $solicitud)
                <tr>
                    <td>{{$solicitud->id}}</td>
                    <td>{{$solicitud->fecha}}</td>
                    <td>{{$solicitud->sala->sala}}</td>
                    <td>{{$solicitud->actividad}}</td>
                    <td>{{$solicitud->hora_inicio}}</td>
                    <td>{{$solicitud->hora_finalizacion}}</td>
                    <td>{{$solicitud->usuario->usuario}}</td>
                    <td>{{$solicitud->autorizacion->autorizacion}}</td>
                    <td>
                        <form action="{{ route('solicitudes-sala.destroy' , ['solicitudes_sala' => $solicitud->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <a class="btn btn-success" href="{{ route('solicitudes-sala.show' , ['solicitudes_sala' => $solicitud->id])}}">Modificar</a>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <br><span class="badge bg-secondary">No hay solicitudes de sala registradas</span>                  
    @endif

    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrar" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalTitulo">Solicitar sala</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('solicitudes-sala.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="id_sala" class="col-form-label">Sala:</label>
                        <select id="id_sala" class="form-select" name="id_sala">
                            @foreach ($salas as $sala )
                                <option value="{{$sala->id}}">{{$sala->sala}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="fecha" class="col-form-label">Fecha de utilizacion:</label>
                        <input type="date" class="form-control" name="fecha" id="fecha">
                    </div>

                    <div class="mb-3">
                        <label for="hora_inicio" class="col-form-label">Hora de inicio:</label>
                        <input type="time" class="form-control" name="hora_inicio" id="hora_inicio">
                    </div>

                    <div class="mb-3">
                        <label for="hora_finalizacion" class="col-form-label">Hora de finalizacion:</label>
                        <input type="time" class="form-control" name="hora_finalizacion" id="hora_finalizacion">
                    </div>

                    <div class="mb-3">
                        <label for="actividad" class="col-form-label">Descripcion de la actividad:</label>
                        <input type="text" class="form-control" name="actividad" id="actividad">
                    </div>

                    <div class="mb-3">
                        <label for="observaciones" class="col-form-label">Observaciones:</label>
                        <input type="text" class="form-control" name="observaciones" id="observaciones">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
            </div>
        </div>
        </div>
    </div>
@endsection