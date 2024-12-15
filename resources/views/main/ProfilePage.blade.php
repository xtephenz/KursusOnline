@extends('layout.master')
@section('content')
    <div class="container mb-5 mt-4" style="max-width: 450px; border: 2px solid #ccc; border-radius: 10px; padding: 20px;">
        <h4 class="text-center mb-4">Your Profile</h4>
        <form class="p-3" action="{{ route('profilePage.update') }}" method="post" enctype="multipart/form-data" id="updateprofile">
            @csrf
            @method('PUT')
            {{-- Photo --}}
            <div class="mb-4 d-flex flex-column align-items-center">
                @if (Auth::user()->photo != null)
                    <img src="{{ Storage::disk('s3')->url(Auth::user()->photo) }}" alt="User's photo" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                @else
                    <img src="{{ asset('images/EmptyProfile.png') }}" alt="Default profile picture" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                @endif
            </div>

            {{-- Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ Auth::user()->name }}">
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}" readonly>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Date of Birth --}}
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" name="dob" id="dob" value="{{ Auth::user()->date_of_birth }}">
                @error('dob')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Upload Photo --}}
            <div class="mb-3">
                <label for="photo" class="form-label">Upload Photo</label>
                <input type="file" class="form-control" name="photo" id="photo">
                @error('photo')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </form>
        {{-- Buttons Section --}}
        <div class="d-flex justify-content-center gap-2">
            {{-- Update Button --}}
            <div class="d-flex justify-content-center mb-3">
                <button form="updateprofile" type="submit" class="btn btn-primary">Update Profile</button>
            </div>
            {{-- Delete Photo Button --}}
            @if (Auth::user()->photo != null)
                <form action="{{ route('profilePage.delete') }}" method="post" id="deleteform">
                    @csrf
                    @method('DELETE')
                    <div class="d-flex justify-content-center mb-3">
                        <button type="submit" class="btn btn-danger">Delete Photo</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
