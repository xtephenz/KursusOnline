@extends('layout.master')
@section('content')
    <div class="container mb-3 mt-4" style="width: 450px; border: 2px solid black; border-radius: 10px">
        <div class="position-relative">
            <a href="{{ route('homePage.view') }}" class="position-absolute" style="left: 0;">
                <img src="{{ asset('BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
        </div>
        <h4 class="text-center mt-2">Change Password</h4>
        @if (session('success'))
            <div class="alert alert-success mt-3 mx-2">{{session('success')}}</div>
        @endif
        <form class="p-3" action="{{ route('changePasswordPage.update') }}" method="post">
            @csrf
            @method('PUT')
            {{-- Current Password --}}
            <div class="mb-3">
                <label for="currentPassword" class="form-label">Current Password</label>
                <input type="password" class="form-control" name="currentPassword" id="currentPassword">
                @if ($errors->has('currentPassword'))
                    <div class="alert alert-danger">
                        {{ $errors->first('currentPassword') }}
                    </div>
                @endif
            </div>
            {{-- New Password --}}
            <div class="mb-3">
                <label for="newPassword" class="form-label">New Password</label>
                <input type="password" class="form-control" name="newPassword" id="newPassword">
                @error('newPassword')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            {{-- Confirm Password --}}
            <div class="mb-3">
                <label for="newPassword_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" name="newPassword_confirmation" id="newPassword_confirmation">
                @error('newPassword_confirmation')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-primary">Change Password</button>
            </div>
        </form>
    </div>
    @for ($i = 0; $i < 15; $i++)
        <br>
    @endfor
@endsection