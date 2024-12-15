@extends('layout.master')

@section('content')
<div class="container d-flex justify-content-center align-items-center my-5">
    <div class="card p-4 shadow-lg" style="max-width: 500px; border-radius: 10px;">
        <h4 class="text-center mb-4" style="color: #333;">Create an Account</h4>

        <form action="{{ route('registerPage.register') }}" method="POST">
            @csrf

            <!-- Full Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="John Doe" value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Gender -->
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="maleGender" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }}>
                        <label class="form-check-label" for="maleGender">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }}>
                        <label class="form-check-label" for="femaleGender">Female</label>
                    </div>
                </div>
                @error('gender')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Date of Birth -->
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" name="dob" id="dob" value="{{ old('dob') }}">
                @error('dob')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Role -->
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-select">
                    <option value="" disabled selected>-- Select a Role --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="john.doe@domain.com" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                @error('password_confirmation')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Terms & Conditions -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="tnc" id="tnc" {{ old('tnc') ? 'checked' : '' }}>
                <label class="form-check-label" for="tnc">I agree to the terms & conditions</label>
                @error('tnc')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </div>
        </form>

        <p class="text-center mt-3">
            Already have an account? <a href="{{ route('loginPage.view') }}" class="text-primary">Login here!</a>
        </p>
    </div>
</div>
@endsection
