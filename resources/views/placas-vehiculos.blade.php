@php
if (Auth::user()->rol->rol != "Administrador"){
header("Location: home");
die();
}
@endphp

@section('css-fullcalendar')
<link href="{{ asset('css/DataTables.css') }}" rel="stylesheet">
@endsection

@extends('layouts.app')

@section('content')
<h3 class="mb-4">Números de placa</h3>

<button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar nuevo número de placa</button>

@include('layouts.mensajesSala')

@if (sizeof($placas) > 0)
<div class="table-responsive">
    <table id="salas" class="table table-striped table-hover table-bordered table-sm shadow">
        <thead>
            <tr class="table-dark">
                <th>#</th>
                <th>Número de placa</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($placas as $placa)
            <tr>
                <td>{{$placa->id}}</td>
                <td>{{$placa->placa}}</td>
                <td>
                    <form action="{{ route('placas-vehiculos.destroy' , 
                        ['placas_vehiculo' => $placa->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf

                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<br><span class="badge bg-secondary">No hay placas registradas</span>
@endif

<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitulo">Registra nueva placa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('placas-vehiculos.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="placa" class="col-form-label">Número de placa:</label>
                        <input type="text" class="form-control" name="placa" id="placa">
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