<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KursusOnline</title>
    <link rel="icon" href="{{ asset('Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
    @include('component.Navbar')
    @if(session('empty_query'))
        <script>
            alert('Please enter a search query.');
        </script>
    @endif
    @yield('content')
    @include('component.Footer')
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>