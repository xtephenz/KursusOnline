@extends('layout.master')
@section('content')
    <div class="container mb-3 mt-4" style="width: 450px; border: 2px solid black; border-radius: 10px">
        <h4 class="text-center mt-2">Add New Material</h4>
        <form class="p-3" action="{{ route('profilePage.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- Photo --}}
            <div class="mb-3 d-flex flex-column align-items-center">
                @if (Auth::user()->photo != null)
                    <img src="{{ Storage::disk('s3')->url(Auth::user()->photo) }}" alt="User's photo" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                    <button type="button" class="btn btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#deletePhotoModal">
                        Delete Photo
                    </button>
                    <div class="modal fade" id="deletePhotoModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete your profile picture?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('profilePage.delete') }}" method="POST" id="confirmDeleteForm">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <img src="{{ asset('images/EmptyProfile.png') }}" alt="Default profile picture" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                @endif
            </div>
            {{-- Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{Auth::user()->name}}">
                @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="{{Auth::user()->email}}" readonly>
                @error('email')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            {{-- Date of Birth --}}
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" name="dob" id="dob" value="{{Auth::user()->date_of_birth}}">
                @error('dob')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div> 
            {{-- Photo --}}
            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" class="form-control" name="photo" id="photo">
                @error('photo')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
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