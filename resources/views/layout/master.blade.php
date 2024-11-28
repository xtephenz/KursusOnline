<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KursusOnline</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
    @include('component.Navbar')
    <div class="container my-2">
        @if(Auth::check())
            <h5 class="text-end">Welcome, {{ Auth::user()->name }}</h5>
        @else
            <h5 class="text-end">Welcome to Kursus Online!</h5>
        @endif
    </div>
    @yield('content')
    @include('component.Footer')
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>