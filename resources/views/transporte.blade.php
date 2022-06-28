@section('css-fullcalendar')
<link href="{{ asset('css/DataTables.css') }}" rel="stylesheet">
@endsection

@extends('layouts.app')

@section('content')
<h3 class="mb-4">Hoja de control de transporte</h3>

<button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar nuevo transporte</button>

@include('layouts.mensajesActividades')

@if (sizeof($transportes) > 0)
<div class="table-responsive">
    <table id="actividades" class="table table-striped table-hover table-bordered table-sm shadow">
        <thead>
            <tr class="table-dark">
                <th>Fecha</th>
                <th>Conductor</th>
                <th>Pasajero</th>
                <th>Lugar destino</th>
                <th>Vehiculo</th>
                <th>Km salida</th>
                <th>Km llegada</th>
                <th>Distancia</th>
                <th>Combustible</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transportes->reverse() as $transporte)
            <tr>
                <td>{{$transporte->fecha}}</td>
                <td>{{$transporte->conductor->nombres}} {{$transporte->conductor->apellidos}}</td>
                <td>{{$transporte->pasajeros->nombres}} {{$transporte->pasajeros->apellidos}}</td>
                <td>{{$transporte->lugar_d->nombre}}</td>
                <td>{{$transporte->vehiculo->placa}}</td>
                <td>{{$transporte->km_salida}}</td>
                <td>{{$transporte->km_destino}}</td>
                <td>{{$transporte->distancia_recorrida}}</td>
                <td>{{$transporte->combustible}}</td>

                <td>
                    <div class="d-grid gap-1 d-md-flex">
                        <a class="btn btn-info btn-sm" href="{{ route('transporte.show' , ['transporte' => $transporte->id])}}">Ver</a>
                        @if (Auth::user()->rol->id == "1")
                        <form action="{{ route('transporte.destroy' , ['transporte' => $transporte->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <a class="btn btn-success btn-sm" href="{{ route('transporte.edit' , ['transporte' => $transporte->id])}}">Modificar</a>
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
                            <option value="{{$dependencia->id}}">{{$dependencia->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_coductor" class="col-form-label">Conductor:</label>
                        <select id="id_coductor" class="form-select" name="id_coductor">
                            @foreach ($usuarios as $usuario )
                            @if ($usuario->motorista == 'si')
                            <option value="{{$usuario->id}}">{{$usuario->nombres}} {{$usuario->apellidos}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_placa" class="col-form-label">Placa:</label>
                        <select id="id_placa" class="form-select" name="id_placa">
                            @foreach ($placas as $placa )
                            <option value="{{$placa->id}}">{{$placa->placa}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="col-form-label">Fecha:</label>
                        <input type="date" class="form-control" name="fecha" id="fecha">
                    </div>

                    <h5>Datos de salida</h5>

                    <div class="mb-3">
                        <label for="hora_salida" class="col-form-label">Hora salida:</label>
                        <input type="time" class="form-control" name="hora_salida" id="hora_salida">
                    </div>

                    <div class="mb-3">
                        <label for="km_salida" class="col-form-label">Kilometraje salida:</label>
                        <input type="text" class="form-control" name="km_salida" id="km_salida">
                    </div>

                    <div class="mb-3">
                        <label for="lugar_salida" class="col-form-label">Lugar salida:</label>
                        <select id="lugar_salida" class="form-select" name="lugar_salida">
                            @foreach ($lugares as $lugar )
                            @if ($lugar->id == 3)
                            <option value="{{$lugar->id}}">{{$lugar->nombre}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <h5>Datos de destino</h5>

                    <div class="mb-3">
                        <label for="hora_destino" class="col-form-label">Hora destino:</label>
                        <input type="time" class="form-control" name="hora_destino" id="hora_destino">
                    </div>

                    <div class="mb-3">
                        <label for="km_destino" class="col-form-label">Kilometraje destino:</label>
                        <input type="text" class="form-control" name="km_destino" id="km_destino">
                    </div>

                    <div class="mb-3">
                        <label for="lugar_destino" class="col-form-label">Lugar destino:</label>
                        <select id="lugar_destino" class="form-select" name="lugar_destino">
                            @foreach ($lugares as $lugar )
                            <option value="{{$lugar->id}}">{{$lugar->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <h5>Otros datos</h5>

                    <div class="mb-3">
                        <label for="distancia_recorrida" class="col-form-label">Distancia recorrida:</label>
                        <input type="text" class="form-control" name="distancia_recorrida" id="distancia_recorrida">
                    </div>

                    <div class="mb-3">
                        <label for="combustible" class="col-form-label">Combustible GLS de</label>
                        <select name="tipo_combustible" id="tipo_combustible" class="form-select">
                            <option value="Salud">Salud</option>
                            <option value="Otros">Otros</option>
                        </select>
                        <input type="text" class="form-control" name="combustible" id="combustible">
                    </div>

                    <div class="mb-3">
                        <label for="pasajero" class="col-form-label">Pasajero:</label>
                        <select id="pasajero" class="form-select" name="pasajero">
                            @foreach ($usuarios as $usuario )
                            <option value="{{$usuario->id}}">{{$usuario->nombres}} {{$usuario->apellidos}}</option>
                            @endforeach
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
        $('#actividades tbody').on('click', 'tr', function() {
            $(this).toggleClass('selected');
        });

        $('#actividades').DataTable({
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