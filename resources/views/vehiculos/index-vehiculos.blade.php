@php
    if (Auth::user()->rol->rol != "Administrador"){
        header("Location: home");
        die();
    }
@endphp

@section('css-data-table')
    <link href="{{ asset('css/DataTables.css') }}" rel="stylesheet">
@endsection

@extends('layouts.app')

@section('content')
    <h3 class="mb-4">Vehiculos</h3>

    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar nuevo vehiculo</button>

    @include('layouts.alerts')
    @include('vehiculos.alerts')

    @if (sizeof($vehiculos) > 0)
        <div class="table-responsive">
            <table id="salas" class="table table-striped table-hover table-bordered table-sm shadow">
                <thead>
                    <tr class="table-dark">
                        <th>#</th>
                        <th>Número de placa</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Kilometraje</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehiculos as $vehiculo)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$vehiculo->placa}}</td>
                        <td>{{$vehiculo->marca}}</td>
                        <td>{{$vehiculo->modelo}}</td>
                        <td>{{$vehiculo->kilometraje}}</td>
                        <td>
                            <form action="{{ route('vehiculos.destroy' , ['vehiculo' => $vehiculo->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <div class="d-grid gap-1 d-md-flex">
                                    <a class="btn btn-info btn-sm" href="{{ route('vehiculos.show' , ['vehiculo' => $vehiculo->id])}}">Ver</a>
                                    <a class="btn btn-success btn-sm" href="{{ route('vehiculos.edit' , ['vehiculo' => $vehiculo->id])}}">Modificar</a>
                                    <input name="_method" type="hidden" value="DELETE"><input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Eliminar</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <br><span class="badge bg-secondary">No hay vehiculos registradas</span>
    @endif

    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitulo">Registra nuevo vehiculo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('vehiculos.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="placa" class="col-form-label">Número de placa:</label>
                            <input type="text" class="form-control" name="placa" id="placa" value="{{ old('placa') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="marca" class="col-form-label">Marca:</label>
                            <input type="text" class="form-control" name="marca" id="marca" value="{{ old('marca') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="modelo" class="col-form-label">Modelo:</label>
                            <input type="text" class="form-control" name="modelo" id="modelo" value="{{ old('modelo') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="color" class="col-form-label">Color:</label>
                            <input type="text" class="form-control" name="color" id="color" value="{{ old('color') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="year" class="col-form-label">Año:</label>
                            <input type="number" class="form-control" name="year" id="year" value="{{ old('year') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="km" class="col-form-label">Kilometraje:</label>
                            <input type="number" min="0" class="form-control" name="km" id="km" value="{{ old('km') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipo_combustible" class="col-form-label">Tipo de combustible:</label>
                            <select class="form-select" name="tipo_combustible" id="tipo_combustible">
                                <option value="Gasolina">Gasolina</option>
                                <option value="Diesel">Diesel</option>
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
            $('#salas tbody').on('click', 'tr', function() {
                $(this).toggleClass('selected');
            });

            $('#salas').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
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