@extends('layout.master')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if ($errors->has('login'))
            <div class="alert alert-danger">
                {{ $errors->first('login') }}
            </div>
        @endif
        <form action="{{ route('loginPage.login') }}" method="post">
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
            <button type="submit" class="btn btn-primary">Login</button>        
        </form>
    </div>
@endsection