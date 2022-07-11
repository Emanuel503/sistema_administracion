@extends('layouts.app')

@section('css-data-table')
    <link href="{{ asset('css/DataTables.css') }}" rel="stylesheet">
@endsection

@section('content')
    <h3 class="mb-4">Solicitud de Combustible</h3>

    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar nueva solicitud combustible</button>

    @include('layouts.alerts')
    @include('solicitud-combustible.alerts')

    @if (sizeof($solicitudes) > 0)
        <div class="table-responsive">
            <table id="solicitudCombustible" class="table table-striped table-hover table-bordered table-sm shadow">
                <thead>
                    <tr class="table-dark">
                        <th>Fecha</th>
                        <th>Conductor</th>
                        <th>Lugar destino</th>
                        <th>Vehiculo</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($solicitudes as $solicitud)
                    <tr>
                        <td>{{$solicitud->fecha_solicitud}}</td>
                        <td>{{$solicitud->conductor->nombres}} {{$solicitud->conductor->apellidos}}</td>
                        <td>{{$solicitud->lugar_d->nombre}}</td>
                        <td>{{$solicitud->vehiculo->placa}}</td>
                        <td>
                            <div class="d-grid gap-1 d-md-flex">
                                <a class="btn btn-info btn-sm" href="{{ route('solicitud-combustible.show' , ['solicitud_combustible' => $solicitud->id])}}">Ver</a>
                                <form action="{{ route('solicitud-combustible.destroy' , ['solicitud_combustible' => $solicitud->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-success btn-sm" href="{{ route('solicitud-combustible.edit' , ['solicitud_combustible' => $solicitud->id])}}">Modificar</a>
                                    <input name="_method" type="hidden" value="DELETE"><input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <br><span class="badge bg-secondary">No hay solicitudes registradas</span>
    @endif

    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitulo">Registra nueva solicitud</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('solicitud-combustible.store') }}" method="POST">
                        <h5>Datos de la solicitud de combustible</h5>
                        @csrf
                        <div class="mb-3">
                            <label for="id_destinatario" class="col-form-label">Para:</label>
                            <select id="id_destinatario" class="form-select" name="id_destinatario">
                                @foreach ($usuarios as $usuario)
                                    @if ($usuario->id_rol == 6)
                                        <option @selected( old('id_destinatario')==$usuario->id) value="{{$usuario->id}}">{{$usuario->nombres}} {{$usuario->apellidos}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="id_origen" class="col-form-label">De:</label>
                            <select id="id_origen" class="form-select" name="id_origen">
                                @foreach ($usuarios as $usuario )
                                    <option @selected( old('id_origen')==$usuario->id) value="{{$usuario->id}}">{{$usuario->nombres}} {{$usuario->apellidos}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_solicitud" class="col-form-label">Fecha solicitud:</label>
                            <input type="date" class="form-control" name="fecha_solicitud" id="fecha_solicitud" value="{{ old('fecha_solicitud') }}" required>
                        </div>

                        <h5>Detalles de la solicitud</h5>

                        <div class="mb-3">
                            <label for="id_vehiculo" class="col-form-label">Placa:</label>
                            <select id="id_vehiculo" class="form-select" name="id_vehiculo">
                                @foreach ($vehiculos as $vehiculo )
                                    <option @selected( old('id_vehiculo')==$vehiculo->id) value="{{$vehiculo->id}}">{{$vehiculo->placa}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="id_conductor" class="col-form-label">Conductor:</label>
                            <select id="id_conductor" class="form-select" name="id_conductor">
                                @foreach ($usuarios as $usuario)
                                    @if ($usuario->id_rol == 5 || $usuario->motorista == 'si')
                                        <option @selected( old('id_conductor')==$usuario->id) value="{{$usuario->id}}">{{$usuario->nombres}} {{$usuario->apellidos}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="lugar_destino" class="col-form-label">Lugar destino:</label>
                            <select id="lugar_destino" class="form-select" name="lugar_destino">
                                @foreach ($lugares as $lugar )
                                    <option @selected( old('lugar_destino')==$lugar->id) value="{{$lugar->id}}">{{$lugar->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_detalle" class="col-form-label">Día:</label>
                            <input type="date" class="form-control" name="fecha_detalle" id="fecha_detalle" value="{{ old('fecha_detalle') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="hora_salida" class="col-form-label">Hora de salida:</label>
                            <input type="time" class="form-control" name="hora_salida" id="hora_salida" value="{{ old('hora_salida') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="objetivo" class="col-form-label">Objetivo de la misión:</label>
                            <textarea class="form-control" name="objetivo" id="objetivo" required>{{ old('objetivo') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="tipo_combustible" class="col-form-label">Solicita tipo de combustible:</label>
                            <select name="tipo_combustible" id="tipo_combustible" class="form-select">
                                <option @selected( old('tipo_combustible')=='Diesel' ) value="Diesel">Diesel</option>
                                <option @selected( old('tipo_combustible')=='Gasolina' ) value="Gasolina">Gasolina</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="cantidad_combustible" class="col-form-label">Cantidad de galones autorizado:</label>
                            <input type="number" class="form-control" name="cantidad_combustible" id="cantidad_combustible" value="{{ old('cantidad_combustible') }}" required>
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
            $('#solicitudCombustible tbody').on('click', 'tr', function() {
                $(this).toggleClass('selected');
            });

            $('#solicitudCombustible').DataTable({
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

@section('js-alert-delete')
    <script src="{{ asset('js/alert-delete.js') }}"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `¿Seguro que desea borrar este registro?`,
                    text: "Si elimina este registro no se podra recuperar.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection