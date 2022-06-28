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
    <h3 class="mb-4">Dependencias</h3>

    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar nueva dependencia</button>

    @include('layouts.mensajesDependenciasTransporte')

    @if (sizeof($dependencias) > 0)
        <div class="table-responsive">
        <table id="dependencia" class="table table-striped table-hover table-bordered table-sm shadow">
            <thead>
                <tr class="table-dark">
                    <th>#</th>
                    <th>Nombre de la dependencia</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dependencias as $dependencia)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$dependencia->nombre}}</td>
                    <td>
                        <form action="{{ route('dependencias-transporte.destroy' , ['dependencias_transporte' => $dependencia->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <div class="d-grid gap-1 d-md-flex">
                                <a class="btn btn-info btn-sm" href="{{ route('dependencias-transporte.show' , ['dependencias_transporte' => $dependencia->id])}}">Ver</a>
                                <a class="btn btn-success btn-sm" href="{{ route('dependencias-transporte.edit' , ['dependencias_transporte' => $dependencia->id])}}">Modificar</a>
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    @else
        <br><span class="badge bg-secondary">No hay dependencias registradas</span>
    @endif

    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitulo">Registra nueva dependencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dependencias-transporte.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="col-form-label">Nombre de la dependencia:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre">
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
            $('#dependencia tbody').on('click', 'tr', function () {
                $(this).toggleClass('selected');
            });

            $('#dependencia').DataTable({
                "language": { "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"}
            });
        });
    </script>
@endsection