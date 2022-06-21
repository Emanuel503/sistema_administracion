@extends('layouts.app')

@section('content')
<h3 class="mb-4">Actividades</h3>

<button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar nueva actividad</button>

@include('layouts.mensajesUsers')

@if (sizeof($actividades) > 0)
<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr class="table-dark">
            <th>#</th>
            <th>Organizador evento</th>
            <th>Coordinador / Asistente</th>
            <th>Lugar</th>
            <th>Nombre de actividad</th>
            <th>Fecha inicio</th>
            <th>Fecha finalización</th>
            <th>Hora inicio</th>
            <th>Hora finalización</th>
            <th>Objetivo</th>
            <th>Observaciones</th>
            <th>Estado actividad</th>
            <th colspan="2">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($actividades as $actividad)
        <tr>
            <td>{{$actividad->id}}</td>
            <td>{{$actividad->organizador->nombre}}</td>
            <td>{{$actividad->coordinador->nombres}}</td>
            <td>{{$actividad->lugar->nombre}}</td>
            <td>{{$actividad->nombre_actividad}}</td>
            <td>{{$actividad->fecha_inicio}}</td>
            <td>{{$actividad->fecha_finalizacion}}</td>
            <td>{{$actividad->hora_inicio}}</td>
            <td>{{$actividad->hora_finalizacion}}</td>
            <td>{{$actividad->objetivo}}</td>
            <td>{{$actividad->observaciones}}</td>
            <td>{{$actividad->estado->tipo_estado}}</td>
            <td>
                <form action="{{ route('actividades.destroy' , ['actividade' => $actividad->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <a class="btn btn-primary" href="{{ route('actividades.show' , ['actividade' => $actividad->id])}}">Modificar</a>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<br><span class="badge bg-secondary">No hay actividadds registradas</span>
@endif

<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitulo">Registra nueva actividad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('actividades.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="id_organizador" class="col-form-label">Organizador del evento:</label>
                        <select id="id_organizador" class="form-select" name="id_organizador">
                            @foreach ($organizadores as $organizador )
                            <option value="{{$organizador->id}}">{{$organizador->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_coordinador" class="col-form-label">Coordinador / Asistente:</label>
                        <select id="id_coordinador" class="form-select" name="id_coordinador">
                            @foreach ($usuarios as $usuario )
                            <option value="{{$usuario->id}}">{{$usuario->nombres}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_lugar" class="col-form-label">Lugar:</label>
                        <select id="id_lugar" class="form-select" name="id_lugar">
                            @foreach ($lugares as $lugar )
                            <option value="{{$lugar->id}}">{{$lugar->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nombre_actividad" class="col-form-label">Nombre de actividad:</label>
                        <input type="text" class="form-control" name="nombre_actividad" id="nombre_actividad">
                    </div>

                    <div class="mb-3">
                        <label for="fecha_inicio" class="col-form-label">Fecha inicio:</label>
                        <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                    </div>

                    <div class="mb-3">
                        <label for="fecha_finalizacion" class="col-form-label">Fecha finalizacion:</label>
                        <input type="date" class="form-control" name="fecha_finalizacion" id="fecha_finalizacion">
                    </div>

                    <div class="mb-3">
                        <label for="hora_inicio" class="col-form-label">Hora inicio:</label>
                        <input type="time" class="form-control" name="hora_inicio" id="hora_inicio">
                    </div>

                    <div class="mb-3">
                        <label for="hora_finalizacion" class="col-form-label">Hora finalizacion:</label>
                        <input type="time" class="form-control" name="hora_finalizacion" id="hora_finalizacion">
                    </div>

                    <div class="mb-3">
                        <label for="objetivo" class="col-form-label">Objetivo:</label>
                        <input type="text" class="form-control" name="objetivo" id="objetivo">
                    </div>

                    <div class="mb-3">
                        <label for="observaciones" class="col-form-label">Observaciones:</label>
                        <input type="text" class="form-control" name="observaciones" id="observaciones">
                    </div>

                    <div class="mb-3">
                        <label for="id_estado" class="col-form-label">Estado:</label>
                        <select id="id_estado" class="form-select" name="id_estado">
                            @foreach ($estados as $estado )
                            <option value="{{$estado->id}}">{{$estado->tipo_estado}}</option>
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