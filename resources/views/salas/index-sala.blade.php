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
<h3 class="mb-4">Salas</h3>

<button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar nueva sala</button>

@include('layouts.alerts')
@include('salas.alerts')

@if (sizeof($salas) > 0)
<div class="table-responsive">
    <table id="salas" class="table table-striped table-hover table-bordered table-sm shadow">
        <thead>
            <tr class="table-dark">
                <th>#</th>
                <th>Nombre de la sala</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salas as $sala)
            <tr>
                <td>{{$sala->id}}</td>
                <td>{{$sala->sala}}</td>
                <td>
                    <form action="{{ route('salas.destroy' , ['sala' => $sala->id])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="d-grid gap-1 d-md-flex">
                            <a class="btn btn-info btn-sm" href="{{ route('salas.show' , ['sala' => $sala->id])}}">Ver</a>
                            <a class="btn btn-success btn-sm" href="{{ route('salas.edit' , ['sala' => $sala->id])}}">Modificar</a>
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
<br><span class="badge bg-secondary">No hay salas registradas</span>
@endif

<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitulo">Registra nueva sala</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('salas.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="sala" class="col-form-label">Nombre sala:</label>
                        <input type="text" class="form-control" name="sala" id="sala" value="{{ old('sala') }}" required>
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