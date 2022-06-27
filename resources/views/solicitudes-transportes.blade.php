@extends('layouts.app')

@section('content')
    <h3 class="mb-4">Solicitudes de transporte</h3>

    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Solicitar transporte</button>

    @include('layouts.mensajesSolicitarSalas')

    @if (sizeof($solicitudesTransportes) > 0)
        <div class="table-responsive">
        <table id="solicitudes-transporte" class="table table-striped table-hover table-bordered table-sm shadow">
            <thead>
                <tr class="table-dark">
                    <th>#</th>
                    <th>Dependencia</th>
                    <th>Fecha solicitud</th>
                    <th>Hora salida</th>
                    <th>Hora regreso</th>
                    <th>Lugar</th>
                    <th>Tecnico</th>
                    <th>Autorizacion</th>
                    <th>Vehiculo</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($solicitudesTransportes->reverse() as $solicitud)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$solicitud->depedencia->nombre}}</td>
                    <td>{{$solicitud->fecha_solicitud}}</td>
                    <td>{{$solicitud->hora_salida}}</td>
                    <td>{{$solicitud->hora_regreso}}</td>
                    <td>{{$solicitud->lugar->nombre}}</td>
                    <td>{{$solicitud->usuario->nombres}} {{$solicitud->usuario->apellidos}}</td>
                    <td></td>
                    <td>{{$solicitud->autorizacion->autorizacion}}</td>
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
                        {{-- <div class="mb-3">
                            <label for="id_dependencia" class="col-form-label">Dependencia:</label>
                            <select id="id_dependencia" class="form-select" name="id_dependencia">
                                @foreach ($dependencias as $dependencia )
                                    <option value="{{$dependencia->id}}">{{$dependencia->nombre}}</option>
                                @endforeach
                            </select>
                        </div> --}}

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
                            <textarea class="form-control" name="actividad" id="actividad"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="observaciones" class="col-form-label">Observaciones:</label>
                            <textarea class="form-control" name="observaciones" id="observaciones"></textarea>
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
            $('#solicitudes-transporte tbody').on('click', 'tr', function () {
                $(this).toggleClass('selected');
            });

            $('#solicitudes-transporte').DataTable({
                language: { "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"}
            });
        });
    </script>
@endsection