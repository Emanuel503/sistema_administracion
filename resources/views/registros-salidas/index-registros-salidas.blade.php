@extends('layouts.app')

@section('css-data-table')
<link href="{{ asset('css/DataTables.css') }}" rel="stylesheet">
@endsection

@section('content')
<h3 class="mb-4">Registros de salidas</h3>

<button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar salida</button>

@include('layouts.alerts')
@include('registros-salidas.alerts')

@if (sizeof($salidas) > 0)
<div class="table-responsive">
    <table id="registros-salida" class="table table-striped table-hover table-bordered table-sm shadow">
        <thead>
            <tr class="table-dark">
                <th>#</th>
                <th>Lugar</th>
                <th>Fecha de salida</th>
                <th>Hora inicio</th>
                <th>Hora finalizacion</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salidas->reverse() as $salida)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$salida->lugar->nombre}}</td>
                <td>{{$salida->fecha}}</td>
                <td>{{$salida->hora_inicio}}</td>
                <td>{{$salida->hora_final}}</td>
                <td>{{$salida->usuario->nombres}} {{$salida->usuario->apellidos}}</td>
                <td>{{$salida->estado->estado}}</td>
                <td>
                    <div class="d-grid gap-1 d-md-flex">
                        <a class="btn btn-info btn-sm" href="{{ route('registros-salida.show' , ['registros_salida' => $salida->id])}}">Ver</a>
                        @if (Auth::user()->id == $salida->id_usuario)
                        <form action="{{ route('registros-salida.destroy' , ['registros_salida' => $salida->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <a class="btn btn-success btn-sm" href="{{ route('registros-salida.edit' , ['registros_salida' => $salida->id])}}">Modificar</a>
                            <input name="_method" type="hidden" value="DELETE"><input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Eliminar</button>
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
<br><span class="badge bg-secondary">No hay registros de salidas registradas</span>
@endif

<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitulo">Registro de salida</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('registros-salida.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="id_lugar" class="col-form-label">Lugar:</label>
                        <select id="id_lugar" class="form-select" name="id_lugar">
                            @foreach ($lugares as $lugar )
                            <option @selected(old('id_lugar')==$lugar->id) value="{{$lugar->id}}">{{$lugar->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="col-form-label">Fecha de salida:</label>
                        <input type="date" class="form-control" name="fecha" id="fecha" value="{{ old('fecha') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="hora_inicio" class="col-form-label">Hora de inicio:</label>
                        <input type="time" class="form-control" name="hora_inicio" id="hora_inicio" value="{{ old('hora_inicio') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="hora_final" class="col-form-label">Hora de finalizacion:</label>
                        <input type="time" class="form-control" name="hora_final" id="hora_final" value="{{ old('hora_final') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="objetivo" class="col-form-label">Objetivo:</label>
                        <textarea required class="form-control" name="objetivo" id="objetivo">{{old('objetivo')}}</textarea>
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
        $('#registros-salida tbody').on('click', 'tr', function() {
            $(this).toggleClass('selected');
        });

        $('#registros-salida').DataTable({
            language: {
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