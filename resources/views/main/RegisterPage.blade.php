@extends('layout.master')

@section('content')
    <div class="container mb-3 mt-4" style="max-width: 500px; border: 2px solid blue; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h4 class="text-center mt-3 mb-4" style="color: blue">Create an Account</h4>

        <form class="p-4" action="{{ route('registerPage.register') }}" method="POST">
            @csrf

            {{-- Full Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="John Doe" value="{{ old('name') }}" required>
                @error('name')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Gender --}}
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="maleGender" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="maleGender">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="femaleGender">Female</label>
                    </div>
                </div>
                @error('gender')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Date of Birth --}}
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" name="dob" id="dob" value="{{ old('dob') }}" required>
                @error('dob')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Role --}}
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="" disabled selected>-- Select a Role --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="john.doe@domain.com" value="{{ old('email') }}" required>
                @error('email')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
                @error('password')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                @error('password_confirmation')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Terms & Condition --}}
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="tnc" id="tnc" {{ old('tnc') ? 'checked' : '' }} required>
                <label class="form-check-label" for="tnc">I agree to the terms & conditions</label>
                @error('tnc')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-outline-primary w-100">Register</button>
            </div>
        </form>

        <p class="text-center">
            Already have an account? <a href="{{ route('loginPage.view') }}">Login here!</a>
        </p>
    </div>
@endsection
