@extends('layout.master')
@section('content')
    <div class="container mb-3 mt-4" style="width: 450px; border: 2px solid black; border-radius: 10px">
        <h4 class="text-center mt-2">Login</h4>
        @if (session('success'))
            <div class="alert alert-success mt-3 mx-2">{{session('success')}}</div>
        @elseif (session('fail'))
            <div class="alert alert-danger mt-3 mx-2">{{ session('fail') }}</div>
        @endif
        <form class="p-3" action="{{ route('loginPage.login') }}" method="post">
            @csrf
            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="john.doe@domain.com" value="{{ old('email') }}">
            </div>
            {{-- Password --}}
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            {{-- Remember Me --}}
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="remember_me" id="remember_me">
                <label class="form-check-label" for="remember_me">Remember Me?</label>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
        <p class="text-center">
            Don't have an account? <a href="{{ route('registerPage.view') }}">Register here!</a>
        </p>
    </div>
    @for ($i = 0; $i < 15; $i++)
        <br>
    @endfor
@endsection