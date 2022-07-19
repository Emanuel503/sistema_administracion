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
<h3 class="mb-4">Permisos</h3>

<button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar nuevo permiso</button>

@include('layouts.alerts')
@include('permisos.alerts')

@if (sizeof($permisos) > 0)
<div class="table-responsive">
    <table id="permisos" class="table table-striped table-hover table-bordered table-sm shadow">
        <thead>
            <tr class="table-dark">
                <th>#</th>
                <th>Usuario</th>
                <th>Dependencia</th>
                <th>Licencia</th>
                <th>Motivo</th>
                <th>Estado</th>
                <th>Usuario autoriza</th>
                <th>Fecha entrada</th>
                <th>Hora entrada</th>
                <th>Fecha salida</th>
                <th>Hora salida</th>
                <th>Fecha permiso</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permisos as $permiso)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    {{$permiso->usuario->nombres}}
                    {{$permiso->usuario->nombres}}
                </td>
                <td>{{$permiso->depen->nombre}}</td>
                <td>{{$permiso->licencia->tipo_permiso}}</td>
                <td>{{$permiso->motiv->motivo}}</td>
                <td>{{$permiso->estado->estado}}</td>
                <td>{{$permiso->usuarioAuto->nombres}} {{$permiso->usuarioAuto->apellidos}}</td>
                <td>{{$permiso->fecha_entrada}}</td>
                <td>{{$permiso->hora_entrada}}</td>
                <td>{{$permiso->fecha_salida}}</td>
                <td>{{$permiso->hora_salida}}</td>
                <td>{{$permiso->fecha_permiso}}</td>
                <td>
                    <div class="d-grid gap-1 d-md-flex">
                        <a class="btn btn-info btn-sm" href="{{ route('permisos.show' , ['permiso' => $permiso->id])}}">Ver</a>
                        @if ($permiso->id_usuario_adiciono == Auth::user()->id)
                        <form action="{{ route('permisos.destroy' , ['permiso' => $permiso->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <a class="btn btn-success btn-sm" href="{{ route('permisos.edit' , ['permiso' => $permiso->id])}}">Modificar</a>
                            <input name="_method" type="hidden" value="DELETE"><input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Eliminar</button>
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
<br><span class="badge bg-secondary">No hay permisos registrados</span>
@endif

<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitulo">Registra nuevo permiso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('permisos.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="usuario" class="col-form-label">Usuario:</label>
                        <select id="usuario" class="form-select" name="usuario">
                            @foreach ($usuarios as $usuario )
                            <option @selected(Auth::user()->id == $usuario->id) value="{{$usuario->id}}">{{$usuario->nombres}} {{$usuario->apellidos}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="dependencia" class="col-form-label">Dependencia:</label>
                        <select id="dependencia" class="form-select" name="dependencia">
                            @foreach ($lugares as $lugar )
                            <option @selected( old('dependencia')==$lugar->id ) value="{{$lugar->id}}">{{$lugar->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="licencia" class="col-form-label">Licencia:</label>
                        <select id="licencia" class="form-select" name="licencia">
                            @foreach ($tipos as $tipo )
                            <option @selected( old('licencia')==$tipo->id ) value="{{$tipo->id}}">{{$tipo->tipo_permiso}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="motivo" class="col-form-label">Motivo:</label>
                        <select id="motivo" class="form-select" name="motivo">
                            @foreach ($motivos as $motivo )
                            <option @selected( old('motivo')==$motivo->id ) value="{{$motivo->id}}">{{$motivo->motivo}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="usuario_autoriza" class="col-form-label">Usuario autoriza:</label>
                        <select id="usuario_autoriza" class="form-select" name="usuario_autoriza">
                            @foreach ($coordinadores as $coordinador )
                            <option @selected( old('usuario_autoriza')==$coordinador->id ) value="{{$coordinador->id}}">{{$coordinador->usuario->nombres}} {{$coordinador->usuario->apellidos}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_entrada" class="col-form-label">Fecha entrada:</label>
                        <input type="date" class="form-control" name="fecha_entrada" id="fecha_entrada" value="{{ old('fecha_entrada') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="hora_entrada" class="col-form-label">Hora entrada:</label>
                        <input type="time" class="form-control" name="hora_entrada" id="hora_entrada" value="{{ old('hora_entrada') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_salida" class="col-form-label">Fecha salida:</label>
                        <input type="date" class="form-control" name="fecha_salida" id="fecha_salida" value="{{ old('fecha_salida') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="hora_salida" class="col-form-label">Hora salida:</label>
                        <input type="time" class="form-control" name="hora_salida" id="hora_salida" value="{{ old('hora_salida') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_permiso" class="col-form-label">Fecha permiso:</label>
                        <input type="date" class="form-control" name="fecha_permiso" id="fecha_permiso" value="{{ old('fecha_permiso') }}" required>
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
        $('#lugares tbody').on('click', 'tr', function() {
            $(this).toggleClass('selected');
        });

        $('#lugares').DataTable({
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