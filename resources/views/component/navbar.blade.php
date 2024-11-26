<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        {{-- ganti jadi logo --}}
        <a class="navbar-brand me-5" href="{{ route('homePage') }}">LOGO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse gap-4 d-flex justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav gap-5">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('homePage') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('aboutUsPage') }}">About Us</a>
                </li>
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li> --}}
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
        <div class="ms-2">
            @if (!Auth::check())
                <a class="btn btn-primary" href="{{ route('loginPage') }}">Login</a>
            @endif
            @if (Auth::check())
                <a class="btn btn-danger" href="{{ route('loginPage.logout') }}">Logout</a>
            @endif
        </div>
    </div>
</nav>