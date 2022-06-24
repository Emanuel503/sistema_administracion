@php
    if (Auth::user()->rol->rol != "Administrador"){
        header("Location: home");
        die();
    }
@endphp

@extends('layouts.app')

@section('content')
    <h3 class="mb-4">Salas</h3>

    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar nueva sala</button>

    @include('layouts.mensajesSala')

    @if (sizeof($salas) > 0)
        <table class="table table-striped table-hover table-bordered">
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
                        <form action="{{ route('salas.destroy' , ['sala' => $sala->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <div class="d-grid gap-1 d-md-flex">
                                <a class="btn btn-info btn-sm" href="{{ route('salas.show' , ['sala' => $sala->id])}}">Ver</a>
                                <a class="btn btn-success btn-sm" href="{{ route('salas.edit' , ['sala' => $sala->id])}}">Modificar</a>
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
                            <input type="text" class="form-control" name="sala" id="sala">
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