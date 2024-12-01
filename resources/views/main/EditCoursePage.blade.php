@extends('layout.master')
@section('content')
    <div class="container mb-3 mt-4" style="width: 450px; border: 2px solid black; border-radius: 10px">
        <div class="position-relative">
            <a href="{{ route('courseDetailPage.view', ['course_id' => $course->id]) }}" class="position-absolute" style="left: 0;">
                <img src="{{ asset('BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
        </div>
        <h4 class="text-center mt-2">Edit Course</h4>
        <form class="p-3" action="{{ route('editCoursePage.update', ['course_id' => $course->id]) }}" method="post">
            @csrf
            @method('PUT')
            {{-- Course Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Course Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="" value="{{$course->name}}" >
                @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            {{-- Lecturer --}}
            <div class="mb-3">
                <label for="lecturer" class="form-label">Lecturer</label>
                <select name="lecturer" id="lecturer" class="form-select" aria-label="Default select example">
                    @foreach ($lecturers as $lecturer)
                        <option value="{{$lecturer->id}}" {{ $lecturer->id == $course->lecturer->id ? 'selected' : '' }}>
                            {{$lecturer->name}}
                        </option>
                    @endforeach
                </select>
                @error('lecturer')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-primary">Update Course</button>
            </div>
        </form>
    </div>
    @include('component.WhiteSpace')
@endsection