@section('css-data-table')
    <link href="{{ asset('css/DataTables.css') }}" rel="stylesheet">
@endsection

@extends('layouts.app')

@section('content')
    <h3 class="mb-4">Control de transporte</h3>

    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar nuevo transporte</button>

    @include('layouts.alerts')
    @include('transporte.alerts')

    @if (sizeof($transportes) > 0)
        <div class="table-responsive">
            <table id="transporte" class="table table-striped table-hover table-bordered table-sm shadow">
                <thead>
                    <tr class="table-dark">
                        <th>Numero</th>
                        <th>Fecha</th>
                        <th>Conductor</th>
                        <th>Pasajero</th>
                        <th>Lugar destino</th>
                        <th>Vehiculo</th>
                        <th>Distancia</th>
                        <th>Combustible</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transportes->reverse() as $transporte)
                    <tr>
                        <td>{{$transporte->correlativo}}</td>
                        <td>{{$transporte->fecha}}</td>
                        <td>{{$transporte->conductor->nombres}} {{$transporte->conductor->apellidos}}</td>
                        <td>{{$transporte->pasajeros->nombres}} {{$transporte->pasajeros->apellidos}}</td>
                        <td>{{$transporte->lugar_d->nombre}}</td>
                        <td>{{$transporte->vehiculo->placa}}</td>
                        <td>{{$transporte->distancia_recorrida}} km</td>
                        <td>{{$transporte->combustible}} gal.</td>
                        <td>
                            <div>
                                <a class="btn btn-info btn-sm mb-1" href="{{ route('transporte.show' , ['transporte' => $transporte->id])}}">Ver</a>
                                <form action="{{ route('transporte.destroy' , ['transporte' => $transporte->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-success btn-sm mb-1" href="{{ route('transporte.edit' , ['transporte' => $transporte->id])}}">Modificar</a>
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
        <br><span class="badge bg-secondary">No hay transportes registradas</span>
    @endif

    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitulo">Registra nuevo transporte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('transporte.store') }}" method="POST">
                        <h5>Datos de la hoja de Control de transporte</h5>
                        @csrf
                        <div class="mb-3">
                            <label for="id_dependencia" class="col-form-label">Dependencia de transporte:</label>
                            <select id="id_dependencia" class="form-select" name="id_dependencia">
                                @foreach ($dependencias as $dependencia)
                                    <option @selected( old('id_dependencia')==$dependencia->id) value="{{$dependencia->id}}">{{$dependencia->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="id_conductor" class="col-form-label">Conductor:</label>
                            <select id="id_conductor" class="form-select" name="id_conductor">
                                @foreach ($usuarios as $usuario)
                                    @if ($usuario->id_rol == 5 || $usuario->motorista == "si" )
                                        <option @selected( old('id_coductor')==$usuario->id) value="{{$usuario->id}}">{{$usuario->nombres}} {{$usuario->apellidos}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="id_placa" class="col-form-label">Placa:</label>
                            <select id="id_placa" class="form-select" name="id_placa">
                                @foreach ($vehiculos as $vehiculo )
                                    <option @selected( old('id_placa')==$vehiculo->id) value="{{$vehiculo->id}}">{{$vehiculo->placa}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fecha" class="col-form-label">Fecha:</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" value="{{ old('fecha') }}" required>
                        </div>

                        <h5>Datos de salida</h5>

                        <div class="mb-3">
                            <label for="hora_salida" class="col-form-label">Hora salida:</label>
                            <input type="time" class="form-control" name="hora_salida" id="hora_salida" value="{{ old('hora_salida') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="km_salida" class="col-form-label">Kilometraje salida:</label>
                            <input type="number" min="0" class="form-control" name="km_salida" id="km_salida" value="{{ old('km_salida') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="lugar_salida" class="col-form-label">Lugar salida:</label>
                            <select id="lugar_salida" class="form-select" name="lugar_salida">
                                @foreach ($lugares as $lugar )
                                    @if ($lugar->id == 1)
                                        <option @selected( old('lugar_salida')==$lugar->id) value="{{$lugar->id}}">{{$lugar->nombre}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <h5>Datos de destino</h5>

                        <div class="mb-3">
                            <label for="hora_destino" class="col-form-label">Hora destino:</label>
                            <input type="time" class="form-control" name="hora_destino" id="hora_destino" value="{{ old('hora_destino') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="km_destino" class="col-form-label">Kilometraje destino:</label>
                            <input type="number" min="0" class="form-control" name="km_destino" id="km_destino" value="{{ old('km_destino') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="lugar_destino" class="col-form-label">Lugar destino:</label>
                            <select id="lugar_destino" class="form-select" name="lugar_destino">
                                @foreach ($lugares as $lugar )
                                    <option @selected( old('lugar_destino')==$lugar->id) value="{{$lugar->id}}">{{$lugar->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <h5>Otros datos</h5>

                        <div class="mb-3">
                            <label for="combustible" class="col-form-label">Combustible GLS de
                                <select name="tipo_combustible" id="tipo_combustible">
                                    <option @selected( old('tipo_combustible')=='Salud' ) value="Salud">Salud</option>
                                    <option @selected( old('tipo_combustible')=='Otros' ) value="Otros">Otros</option>
                                </select>
                            </label>
                            <input type="number" min="0" class="form-control" name="combustible" value="{{ old('combustible') }}" id="combustible" required>
                        </div>

                        <div class="mb-3">
                            <label for="pasajero" class="col-form-label">Pasajero:</label>
                            <select id="pasajero" class="form-select" name="pasajero">
                                @foreach ($usuarios as $usuario )
                                    <option @selected( old('pasajero')==$usuario->id) value="{{$usuario->id}}">{{$usuario->nombres}} {{$usuario->apellidos}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="objetivo" class="col-form-label">Objetivo:</label>
                            <textarea required class="form-control" name="objetivo" id="objetivo">{{old('objetivo')}}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="nivel_tanque" class="col-form-label">Nivel en tanque:</label>
                            <select id="nivel_tanque" class="form-select" name="nivel_tanque">
                                <option value="3/4">3/4</option>
                                <option value="1/2">1/2</option>
                                <option value="1/4">1/4</option>
                            </select>
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
            $('#transporte tbody').on('click', 'tr', function() {
                $(this).toggleClass('selected');
            });

            $('#transporte').DataTable({
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