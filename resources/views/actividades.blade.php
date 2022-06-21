@extends('layouts.app')

@section('content')
<h3 class="mb-4">Actividades</h3>

<button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar nueva actividad</button>

@include('layouts.mensajesUsers')

@if (sizeof($usuarios) > 0)
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
            <td>{{$actividad->id_organizador}}</td>
            <td>{{$actividad->id_coordinador}}</td>
            <td>{{$actividad->id_lugar}}</td>
            <td>{{$actividad->nombre_actividad}}</td>
            <td>{{$actividad->fecha_inicio}}</td>
            <td>{{$actividad->fecha_finalizacion}}</td>
            <td>{{$actividad->hora_inicio}}</td>
            <td>{{$actividad->hora_finalizacion}}</td>
            <td>{{$actividad->objetivo}}</td>
            <td>{{$actividad->observaciones}}</td>
            <td>{{$actividad->estado}}</td>
            <td>
                <form action="{{ route('actividades.destroy' , ['actividades' => $actividad->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <a class="btn btn-success" href="{{ route('actividades.show' , ['actividades' => $actividad->id])}}">Modificar</a>
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


@endsection