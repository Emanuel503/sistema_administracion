@if (session('success'))
    <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('errorEliminar'))
    <div id="alert" class="alert alert-warning alert-dismissible fade show" role="alert">
        {{session('errorEliminar')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('errorHora'))
    <div id="alert" class="alert alert-warning alert-dismissible fade show" role="alert">
        {{session('errorHora')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('errorFecha'))
    <div id="alert" class="alert alert-warning alert-dismissible fade show" role="alert">
        {{session('errorFecha')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif