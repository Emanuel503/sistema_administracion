@extends('layouts.app')

@section('css-data-table')
    <link href="{{ asset('css/DataTables.css') }}" rel="stylesheet">
@endsection

@section('content')
    <h3 class="mb-4">Solicitudes de transporte</h3>

    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Solicitar transporte</button>

    @include('layouts.mensajesSolicitarTransporte')

    @if (sizeof($solicitudesTransportes) > 0)
    <div class="table-responsive">
        <table id="solicitudes" class="table table-striped table-hover table-bordered table-sm shadow">
            <thead>
                <tr class="table-dark">
                    <th>#</th>
                    <th>Dependencia</th>
                    <th>Fecha del transporte</th>
                    <th>Hora salida</th>
                    <th>Hora regreso</th>
                    <th>Lugar</th>
                    <th>Usuario solicitante</th>
                    <th>Autorizacion</th>
                    <th>Vehiculo</th>
                    <th>Motorista</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($solicitudesTransportes->reverse() as $solicitud)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$solicitud->dependencias->nombre}}</td>
                    <td>{{$solicitud->fecha}}</td>
                    <td>{{$solicitud->hora_salida}}</td>
                    <td>{{$solicitud->hora_regreso}}</td>
                    <td>{{$solicitud->lugar->nombre}}</td>
                    <td>{{$solicitud->usuario->nombres}} {{$solicitud->usuario->apellidos}}</td>
                    <td>{{$solicitud->autorizacion->autorizacion}}</td>
                    <td>@if ($solicitud->id_vehiculo == null) Sin asignar @else {{$solicitud->vehiculo->placa}} @endif </td>
                    <td>@if ($solicitud->id_motorista == null) Sin asignar @else {{$solicitud->motorista->nombres}} {{$solicitud->motorista->apellidos}} @endif </td>
                    <td>
                        <div class="d-grid gap-1 d-md-flex">
                            <a class="btn btn-info btn-sm" href="{{ route('solicitudes-transporte.show' ,['solicitudes_transporte' => $solicitud->id])}}">Ver</a>
                            @if (Auth::user()->rol->id == "1")
                            <form action="{{ route('solicitudes-transporte.destroy' , ['solicitudes_transporte' => $solicitud->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <a class="btn btn-success btn-sm" href="{{ route('solicitudes-transporte.edit' , ['solicitudes_transporte' => $solicitud->id])}}">Modificar</a>
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                            @else
                            @if ($solicitud->id_autorizacion == 3)
                            @if (Auth::user()->id == $solicitud->usuario->id)
                            <form action="{{ route('solicitudes-transporte.destroy' , ['solicitudes_transporte' => $solicitud->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <a class="btn btn-success btn-sm" href="{{ route('solicitudes-transporte.edit' , ['solicitudes_transporte' => $solicitud->id])}}">Modificar</a>
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                            @endif
                            @endif
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <br><span class="badge bg-secondary">No hay solicitudes de transporte registrados</span>
    @endif

    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitulo">Solicitar transporte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('solicitudes-transporte.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="id_dependencia" class="col-form-label">Dependencia:</label>
                            <select id="id_dependencia" class="form-select" name="id_dependencia">
                                @foreach ($dependencias as $dependencia )
                                    <option @selected( old('id_dependencia')==$dependencia->id ) value="{{$dependencia->id}}">{{$dependencia->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="id_lugar" class="col-form-label">Lugar:</label>
                            <select id="id_lugar" class="form-select" name="id_lugar">
                                @foreach ($lugares as $lugar )
                                    <option @selected( old('id_lugar')==$lugar->id ) value="{{$lugar->id}}">{{$lugar->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fecha" class="col-form-label">Fecha del transporte:</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" value="{{ old('fecha') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="hora_salida" class="col-form-label">Hora de salida:</label>
                            <input type="time" class="form-control" name="hora_salida" id="hora_salida" value="{{ old('hora_salida') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="hora_regreso" class="col-form-label">Hora de regreso:</label>
                            <input type="time" class="form-control" name="hora_regreso" id="hora_regreso" value="{{ old('hora_regreso') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="objetivo" class="col-form-label">Objetivo:</label>
                            <textarea required class="form-control" name="objetivo" id="objetivo">{{ old('objetivo') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="observaciones" class="col-form-label">Observaciones:</label>
                            <textarea required class="form-control" name="observaciones" id="observaciones">{{ old('observaciones')}}</textarea>
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

@section('js-data-table')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#solicitudes tbody').on('click', 'tr', function() {
                $(this).toggleClass('selected');
            });

            $('#solicitudes').DataTable({
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        });
    </script>
@endsection