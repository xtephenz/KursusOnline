<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KursusOnline</title>
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">    

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body style="min-height: 100vh; display: flex; flex-direction: column;">
    @include('component.Navbar')
    @if(session('empty_query'))
        <script>
            alert('Please enter a search query.');
        </script>
    @endif
    <div class="my-3 pb-5" style="flex-grow: 1;">
        @yield('content')
    </div>
    @include('component.Footer')
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>