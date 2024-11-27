@extends('layout.master')
@section('content')
    <div class="container mb-3 mt-4" style="width: 450px; border: 2px solid black; border-radius: 10px">
        <h4 class="text-center mt-2">Add New Material</h4>
        <form class="p-3" action="{{ route('profilePage.update', ['user_id' => $user->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- Photo --}}
            <div class="mb-3 d-flex flex-column align-items-center">
                @if (Auth::user()->photo != null)
                    <img src="{{ asset('storage/'.$user->photo) }}" alt="User's photo" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                    <form action="{{ route('profilePage.delete', ['user_id' => $user->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger mt-2" value="Delete Photo"></input>
                    </form>
                @else
                    <img src="{{ asset('EmptyProfile.png') }}" alt="Default profile picture" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                @endif
            </div>
            {{-- Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="{{$user->email}}" readonly>
                @error('email')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            {{-- Date of Birth --}}
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" name="dob" id="dob" value="{{$user->date_of_birth}}">
                @error('dob')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div> 
            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" class="form-control" name="photo" id="photo">
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-primary">Update Profile</button>        
            </div>
        </form>
    </div>
    @for ($i = 0; $i < 15; $i++)
        <br>
    @endfor
@endsection