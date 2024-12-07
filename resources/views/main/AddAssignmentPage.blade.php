@extends('layout.master')
@section('content')
    <div class="container mb-3 mt-4" style="width: 450px; border: 2px solid black; border-radius: 10px">
        <div class="position-relative">
            <a href="{{ route('courseDetailPage.assignment', ['course_id' => $course->id]) }}" class="position-absolute" style="left: 0;">
                <img src="{{ asset('images/BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
        </div>
        <h4 class="text-center mt-2">Add New Assignment</h4>
        <form class="p-3" action="{{ route('addAssignmentPage.add', ['course_id' => $course->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- Course --}}
            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" class="form-control" name="course" id="course" value="{{$course->name}}" readonly>
            </div>
            {{-- Title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Top Down Parsing" value="{{old('title')}}" >
                @error('title')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            {{-- Assignment File --}}
            <div class="mb-3">
                <label for="assignment" class="form-label">Assignment</label>
                <input type="file" class="form-control" name="assignment" id="assignment" >
                @error('assignment')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div> 
            {{-- Attempts --}}
            <div class="mb-3">
                <label for="attempts" class="form-label">Attempts</label>
                <input type="number" class="form-control" name="attempts" id="attempts" value="{{old('attempts')}}" >
                @error('attempts')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            {{-- Start Date --}}
            <div class="mb-3">
                <label for="start" class="form-label">Start Date</label>
                <input type="date" class="form-control" name="start" id="start" value="{{ old('start') }}">
                @error('start')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            {{-- Due Date --}}
            <div class="mb-3">
                <label for="due" class="form-label">Due Date</label>
                <input type="date" class="form-control" name="due" id="due" value="{{ old('due') }}">
                @error('due')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-primary">Add Assignment</button>
            </div>
        </form>
    </div>
    @include('component.WhiteSpace')
@endsection