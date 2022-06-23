@extends('layouts.app')

@section('content')
    <h3 class="mb-4 text-center">Calendario de actividades de Dirección de Salud Medio Ambiental</h3>
    <div class="bg-dark mt-3 p-3 bg-opacity-25 rounded container-sm col-8 mx-auto" id="calendar">
    </div>

    <div class="d-grid gap-2 col-6 mx-auto my-4 col-5">
        <a class="btn btn-primary " href="{{route('actividades.index')}}">Registrar Actividad</a>
    </div>
@endsection