@extends('layout.master')

@section('content')
    <div class="container my-4" style="max-width: 450px; border: 2px solid black; border-radius: 10px; padding: 20px;">
        <div class="position-relative mb-3">
            <a href="{{ route('homePage.view') }}" class="position-absolute" style="left: 0; top: -10px;">
                <img src="{{ asset('images/BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
        </div>

        <h4 class="text-center mb-3">Change Password</h4>

        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <form action="{{ route('changePasswordPage.update') }}" method="post">
            @csrf
            @method('PUT')

            {{-- Current Password --}}
            <div class="mb-3">
                <label for="currentPassword" class="form-label">Current Password</label>
                <input type="password" class="form-control" name="currentPassword" id="currentPassword" autocomplete="current-password">
                @error('currentPassword')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- New Password --}}
            <div class="mb-3">
                <label for="newPassword" class="form-label">New Password</label>
                <input type="password" class="form-control" name="newPassword" id="newPassword" autocomplete="new-password">
                @error('newPassword')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Confirm New Password --}}
            <div class="mb-3">
                <label for="newPassword_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" name="newPassword_confirmation" id="newPassword_confirmation" autocomplete="new-password">
                @error('newPassword_confirmation')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-primary w-100">Change Password</button>
            </div>
        </form>
    </div>
@endsection
