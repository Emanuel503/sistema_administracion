@yield('menu')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
 	        <a class="navbar-brand" href="{{url('/home')}}">Sistema de administracion</a>

             @guest
             @if (Route::has('login'))
             @endif
             @else
             
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="main_nav">
                <ul class="navbar-nav">
                    <li class="nav-item active"> <a class="nav-link" href="{{url('/home')}}">Agenda</a> </li>
                    <li class="nav-item dropdown dropdown-dark">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Ingreso de datos</a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="#">Actividades</a></li>
                            <li><a class="dropdown-item" href="#"> Transporte &raquo; </a>
                                <ul class="submenu dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="#">Solicitud de transporte</a></li>
                                    <li><a class="dropdown-item" href="#">Transporte</a></li>
                                    <li><a class="dropdown-item" href="#">Combustible</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="#">Solicitudes de sala</a></li>
                        </ul>
                    </li>
	            </ul>
                <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->nombres }}
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
                    @endguest
                </ul>
            </div>
        </div>
    </nav>