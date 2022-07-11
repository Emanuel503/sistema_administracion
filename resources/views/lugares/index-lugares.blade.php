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
<h3 class="mb-4">Lugares</h3>

<button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar nuevo lugar</button>

@include('layouts.alerts')
@include('lugares.alerts')

@if (sizeof($lugares) > 0)
<div class="table-responsive">
    <table id="lugares" class="table table-striped table-hover table-bordered table-sm shadow">
        <thead>
            <tr class="table-dark">
                <th>#</th>
                <th>Nombre del lugar</th>
                <th>Codigo</th>
                <th>Departamento</th>
                <th>Municipio</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lugares as $lugar)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$lugar->nombre}}</td>
                <td>{{$lugar->codigo}}</td>
                <td>{{$lugar->departamentos->departamento}}</td>
                <td>{{$lugar->municipios->municipio}}</td>
                <td>
                    <form action="{{ route('lugares.destroy' , ['lugare' => $lugar->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="d-grid gap-1 d-md-flex">
                            <a class="btn btn-info btn-sm" href="{{ route('lugares.show' , ['lugare' => $lugar->id])}}">Ver</a>
                            <a class="btn btn-success btn-sm" href="{{ route('lugares.edit' , ['lugare' => $lugar->id])}}">Modificar</a>
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
<br><span class="badge bg-secondary">No hay lugares registrados</span>
@endif

<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitulo">Registra nuevo lugar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('lugares.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="col-form-label">Nombre del lugar:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="codigo" class="col-form-label">Codigo:</label>
                        <input type="text" class="form-control" name="codigo" id="codigo" value="{{ old('codigo') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="id_departamento" class="col-form-label">Departamento:</label>
                        <select name="id_departamento" id="id_departamento" class="form-select">
                            <option selected>Selecciona una opción</option>
                            @foreach ($departamentos as $departamento)
                            <option @selected( old('id_departamento')==$departamento->id ) value="{{ $departamento->id}}">{{$departamento->departamento}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_municipio" class="col-form-label">Municipio:</label>
                        <select name="id_municipio" id="id_municipio" class="form-select">
                            <option selected>Selecciona una opción</option>
                            @foreach ($municipios as $municipio)
                            <option class="{{ $municipio->id_departamento}}" @selected( old('id_municipio')==$municipio->id ) value="{{ $municipio->id}}">{{$municipio->municipio}}</option>
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

    <script>
        document.getElementById("id_departamento").onchange = function() {

            let selector = document.getElementById('id_departamento');
            let value = selector[selector.selectedIndex].value;

            let nodeList = document.getElementById("id_municipio").querySelectorAll("option");

            nodeList.forEach(function(option) {

                if (option.classList.contains(value)) {
                    option.style.display = "block";
                } else {
                    option.style.display = "none";
                }

            });
        }
    </script>
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