<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema administracion</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="http://localhost/sistema_disam/resources/css/menu.css" rel="stylesheet">
</head>
<body>
    
    <div class="container my-4">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="http://localhost/sistema_disam/resources/js/menu.js"></script>
    <script src="http://localhost/sistema_disam/resources/js/jquery-3.6.0.min.js"></script>
</body>
</html>
