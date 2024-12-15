@extends('layout.master')
@section('content')
    <div class="container mb-5 mt-4" style="max-width: 600px; border: 2px solid #ccc; border-radius: 12px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
        <div class="position-relative">
            <a href="{{ route('courseDetailPage.assignment', ['course_id' => $course->id]) }}" class="position-absolute" style="left: 0; top: 0;">
                <img src="{{ asset('images/BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
        </div>
        <h4 class="text-center mt-3 mb-4">Add New Assignment</h4>
        <form class="p-4" action="{{ route('addAssignmentPage.add', ['course_id' => $course->id]) }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- Course --}}
            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" class="form-control" name="course" id="course" value="{{$course->name}}" readonly>
            </div>

            {{-- Title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="e.g., Top Down Parsing" value="{{old('title')}}">
                @error('title')
                    <div class="text-danger mt-1 mb-0">{{$message}}</div>
                @enderror
            </div>

            {{-- Assignment File --}}
            <div class="mb-3">
                <label for="assignment" class="form-label">Assignment File</label>
                <input type="file" class="form-control" name="assignment" id="assignment">
                @error('assignment')
                    <div class="text-danger mt-1 mb-0">{{$message}}</div>
                @enderror
            </div>

            {{-- Attempts --}}
            <div class="mb-3">
                <label for="attempts" class="form-label">Attempts</label>
                <input type="number" class="form-control" name="attempts" id="attempts" value="{{old('attempts')}}" min="1">
                @error('attempts')
                    <div class="text-danger mt-1 mb-0">{{$message}}</div>
                @enderror
            </div>

            {{-- Start Date --}}
            <div class="mb-3">
                <label for="start" class="form-label">Start Date</label>
                <input type="date" class="form-control" name="start" id="start" value="{{ old('start') }}">
                @error('start')
                    <div class="text-danger mt-1 mb-0">{{$message}}</div>
                @enderror
            </div>

            {{-- Due Date --}}
            <div class="mb-3">
                <label for="due" class="form-label">Due Date</label>
                <input type="date" class="form-control" name="due" id="due" value="{{ old('due') }}">
                @error('due')
                    <div class="text-danger mt-1 mb-0">{{$message}}</div>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="d-flex justify-content-center mb-4">
                <button type="submit" class="btn btn-primary w-100">Add Assignment</button>
            </div>
        </form>
    </div>
@endsection
