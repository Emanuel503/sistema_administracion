@section('css-fullcalendar')
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection

@extends('layouts.app')

@section('content')
    <h3 class="mb-4 text-center">Calendario de actividades de Dirección de Salud Ambiental</h3>
    <div class="bg-dark mt-3 p-3 bg-opacity-25 rounded container-sm col-8 mx-auto" id="calendar"></div>

    <div class="d-grid gap-2 col-6 mx-auto my-4 col-5">
        <a class="btn btn-primary " href="{{route('actividades.index')}}">Registrar Actividad</a>
    </div>

    <div class="modal fade" id="actividad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actividades</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" name="formulario">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="title" class="form-label">Titulo:</label>
                            <input type="text" name="title" id="title" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="fecha" class="form-label">Fecha inicio y finalización:</label>
                            <input type="text" name="fecha" id="fecha" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="hora" class="form-label">Hora inicio y finalización:</label>
                            <input type="text" name="hora" id="hora" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="objetivo" class="form-label">Objetivo:</label>
                            <input type="text" name="objetivo" id="objetivo" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="observaciones" class="form-label">Observaciones:</label>
                            <input type="text" name="observaciones" id="observaciones" class="form-control" readonly>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" rel="nofollow" id="enlace" class="btn btn-primary">Ver más detalles</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-fullcalendar')
    <script src="{{ asset('js/agenda.js') }}" defer></script>
    <script src="{{ asset('js/main.min.js') }}"></script>
    <script src="{{ asset('js/locales-all.js') }}"></script>
@endsection