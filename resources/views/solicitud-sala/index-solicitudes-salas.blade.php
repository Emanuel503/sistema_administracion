@extends('layouts.app')

@section('css-data-table')
    <link href="{{ asset('css/DataTables.css') }}" rel="stylesheet">
@endsection

@section('content')
    <h3 class="mb-4">Solicitudes de salas</h3>

    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Solicitar sala</button>

    @include('layouts.alerts')
    @include('solicitud-sala.alerts')

    @if (sizeof($solicitudesSalas) > 0)
        <div class="table-responsive">
            <table id="solicitudes-salas" class="table table-striped table-hover table-bordered table-sm shadow">
                <thead>
                    <tr class="table-dark">
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
                        <td>{{$solicitud->fecha}}</td>
                        <td>{{$solicitud->sala->sala}}</td>
                        <td>{{$solicitud->actividad}}</td>
                        <td>{{$solicitud->hora_inicio}}</td>
                        <td>{{$solicitud->hora_finalizacion}}</td>
                        <td>{{$solicitud->usuario->nombres}} {{$solicitud->usuario->apellidos}}</td>
                        <td>{{$solicitud->autorizacion->autorizacion}}</td>
                        <td>
                            <div class="d-grid gap-1 d-md-flex">
                                <a class="btn btn-info btn-sm" href="{{ route('solicitudes-sala.show' , ['solicitudes_sala' => $solicitud->id])}}">Ver</a>
                                @if (Auth::user()->rol->id == "1" || ($solicitud->id_autorizacion == 3 && Auth::user()->id == $solicitud->usuario->id))
                                    <form action="{{ route('solicitudes-sala.destroy' , ['solicitudes_sala' => $solicitud->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-success btn-sm" href="{{ route('solicitudes-sala.edit' , ['solicitudes_sala' => $solicitud->id])}}">Modificar</a>
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
                                    <option @selected(old('id_sala')==$sala->id) value="{{$sala->id}}">{{$sala->sala}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fecha" class="col-form-label">Fecha de utilizacion:</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" value="{{ old('fecha') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="hora_inicio" class="col-form-label">Hora de inicio:</label>
                            <input type="time" class="form-control" name="hora_inicio" id="hora_inicio" value="{{ old('hora_inicio') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="hora_finalizacion" class="col-form-label">Hora de finalizacion:</label>
                            <input type="time" class="form-control" name="hora_finalizacion" id="hora_finalizacion" value="{{ old('hora_finalizacion') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="actividad" class="col-form-label">Descripcion de la actividad:</label>
                            <textarea required class="form-control" name="actividad" id="actividad">{{old('actividad')}}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="observaciones" class="col-form-label">Observaciones:</label>
                            <textarea required class="form-control" name="observaciones" id="observaciones">{{old('observaciones')}}</textarea>
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
    </div>
@endsection

@section('js-data-table')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#solicitudes-salas tbody').on('click', 'tr', function() {
                $(this).toggleClass('selected');
            });

            $('#solicitudes-salas').DataTable({
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                order: [
                    [0, 'desc']
                ],
            });
        });
    </script>
@endsection