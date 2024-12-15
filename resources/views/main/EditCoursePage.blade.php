@extends('layout.master')

@section('content')
    <div class="container my-4" style="max-width: 450px; border: 2px solid black; border-radius: 10px; padding: 20px;">
        <div class="position-relative mb-3">
            <a href="{{ route('courseDetailPage.view', ['course_id' => $course->id]) }}" class="position-absolute" style="left: 0; top: -10px;">
                <img src="{{ asset('images/BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
        </div>

        <h4 class="text-center mb-3">Edit Course</h4>

        <form action="{{ route('editCoursePage.update', ['course_id' => $course->id]) }}" method="post">
            @csrf
            @method('PUT')

            {{-- Course Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Course Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Course Name" value="{{ old('name', $course->name) }}">
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Lecturer --}}
            <div class="mb-3">
                <label for="lecturer" class="form-label">Lecturer</label>
                <select name="lecturer" id="lecturer" class="form-select">
                    @foreach ($lecturers as $lecturer)
                        <option value="{{ $lecturer->id }}" {{ $lecturer->id == $course->lecturer->id ? 'selected' : '' }}>
                            {{ $lecturer->name }}
                        </option>
                    @endforeach
                </select>
                @error('lecturer')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-primary w-100">Update Course</button>
            </div>
        </form>
    </div>
@endsection
