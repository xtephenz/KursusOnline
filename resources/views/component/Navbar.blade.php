<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        {{-- ganti jadi logo --}}
        <a class="navbar-brand me-5" href="{{ route('homePage.view') }}">
            <img src="{{ asset('images/Logo.png') }}" alt="" width="50px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse gap-4 d-flex justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav gap-5">
                @if ((Auth::check() && Auth::user()->role_id != 1) || !Auth::check())
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('homePage.view') }}">Home</a>
                    </li>
                @endif
                @if ((Auth::check() && Auth::user()->role_id != 3) || !Auth::check())
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('coursesPage.view') }}">Courses</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('aboutUsPage.view') }}">About Us</a>
                </li>
            </ul>
            @if (!Auth::check() || (Auth::check() && Auth::user()->role_id != 3))
                <form class="d-flex" action="{{ route('search') }}" method="get" role="search">
                    <input class="form-control me-2" type="search" name="query" placeholder="Search course by name, lecturer, or topic" aria-label="Search" value="{{ request('query') }}" style="width: 370px">
                    <button class="btn btn-search" type="submit">Search</button>
                </form>
            @endif
        </div>
        <div class="ms-2">
            @if (!Auth::check())
                <a class="btn btn-primary" href="{{ route('loginPage.view') }}">Login</a>
            @else
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (Auth::user()->photo != null)
                                <img src="{{ Storage::disk('s3')->url(Auth::user()->photo) }}" alt="User's photo" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/EmptyProfile.png') }}" alt="Default profile picture" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profilePage.view', ['user_id' => Auth::user()->id]) }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('changePasswordPage.view') }}">Change Password</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                @if (Auth::check())
                                    <a class="dropdown-item text-danger" href="{{ route('loginPage.logout') }}">Logout</a>
                                @endif
                            </li>
                        </ul>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>
