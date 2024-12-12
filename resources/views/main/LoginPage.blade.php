@extends('layout.master')
@section('content')
    <div class="container mb-3 mt-4" style="max-width: 450px; border-radius: 10px; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); padding: 20px;">
        <h4 class="text-center mb-4">Login</h4>

        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @elseif (session('fail'))
            <div class="alert alert-danger mt-3">{{ session('fail') }}</div>
        @endif

        <form action="{{ route('loginPage.login') }}" method="POST">
            @csrf
            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="john.doe@domain.com" value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="remember_me" id="remember_me">
                <label class="form-check-label" for="remember_me">Remember Me?</label>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary btn-block btn-login">Login</button>
            </div>
        </form>

        <p class="text-center mt-3">
            Don't have an account? <a href="{{ route('registerPage.view') }}">Register here!</a>
        </p>
    </div>
@endsection
