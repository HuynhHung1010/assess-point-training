<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/c74a98dfa6.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Hệ thống chấm điểm rèn luyện</title>
    @yield('css')
    @yield('cssslider')
    @yield('csstt')
</head>
<body>
    <div class="container">
        <header>
            @include('clients.layout.sidebar')
        </header>
        <nav>
            <div class="menu">
                @include('clients.layout.menu')
            </div>
        </nav>
        <div class="main">
            {{-- @include('clients.layout.main') --}}
            @yield('content')
        </div>

        <footer>
            @include('clients.layout.footer')
        </footer>
    </div>
    @yield('jsslider')
</body>
</html>
