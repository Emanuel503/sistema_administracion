<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema administracion</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    @yield('css-data-table')
    @yield('css-fullcalendar')
</head>

<body>

    @yield('menu')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{url('/home')}}">Sistema de administracion</a>
            @auth
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="main_nav">
                <ul class="navbar-nav">
                    <li class="nav-item active"> <a class="nav-link" href="{{url('/home')}}">Agenda</a> </li>
                    @if ( Auth::user()->rol->id == "1")
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Catálogos</a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="#">Usuarios &raquo;</a>
                                <ul class="submenu dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="{{route('users.index')}}">Registrar usuarios</a></li>
                                    <li><a class="dropdown-item" href="{{route('coordinadores.index')}}">Asignar coordinador</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="{{route('salas.index')}}">Salas</a></li>
                            <li><a class="dropdown-item" href="{{route('lugares.index')}}">Lugares</a></li>
                            <li><a class="dropdown-item" href="{{route('vehiculos.index')}}">Vehiculos</a></li>
                            <li><a class="dropdown-item" href="{{route('dependencias.index')}}">Dependencias</a></li>
                        </ul>
                    </li>
                    @endif
                    <li class="nav-item dropdown dropdown-dark">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Ingreso de datos</a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="{{route('actividades.index')}}">Actividades</a></li>
                            <li><a class="dropdown-item" href="#"> Transporte &raquo; </a>
                                <ul class="submenu dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="{{route('solicitudes-transporte.index')}}">Solicitud de transporte</a></li>
                                    <li><a class="dropdown-item" href="{{route('transporte.index')}}">Control de transporte</a></li>
                                    <li><a class="dropdown-item" href="{{route('solicitud-combustible.index')}}">Solicitud combustible</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="{{route('solicitudes-sala.index')}}">Solicitudes de sala</a></li>
                            <li><a class="dropdown-item" href="{{route('registros-salida.index')}}">Registros de salida</a></li>
                            <li><a class="dropdown-item" href="{{route('permisos.index')}}">Permisos</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown dropdown-dark">
                        <a class="nav-link dropdown-toggle" href="" data-bs-toggle="dropdown">Reportes</a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="">Control de Transporte &raquo; </a>
                                <ul class="submenu dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="{{route('transporte.bitacoraRecorridos')}}">Bitacora de recorridos</a></li>
                                    <li><a class="dropdown-item" href="{{route('transporte.comsumoCombustible')}}">Consumo de combustible</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->nombres }} ({{Auth::user()->rol->rol}})
                        </a>

                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Cerrar sesion') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
            @endauth
        </div>
    </nav>

    <div class="container my-4">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/funciones.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    @yield('js-fullcalendar')
    @yield('js-data-table')
    @yield('js-solicitud-transporte')
    @yield('js-lugares')
    @yield('js-alert-delete')
</body>

</html>