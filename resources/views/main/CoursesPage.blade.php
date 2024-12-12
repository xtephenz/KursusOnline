@extends('layout.master')
@section('content')
    <div class="container my-2">
        @if(Auth::check() && Auth::user()->role_id == 1)
            <h5 class="text-end">Welcome, {{ Auth::user()->name }}</h5>
        @endif
        @if (session('success'))
            <div class="alert alert-success mt-3 mx-2">{{session('success')}}</div>
        @endif
        <div class="container">
            <h2 class="text-center mb-4" style="font-size: 30px; font-weight: bold; color: #007bff;">Course List</h2>

            @if (Auth::check() && Auth::user()->role_id == 1)
            <div class="d-flex justify-content-end my-2">
                <a href="{{ route('addCoursePage.view') }}" class="btn btn-primary">Add New Course</a>
            </div>
            @endif
            @include('component.CourseCard', ['courses' => $allCourses])
            <div class="my-1">
                {{$allCourses->links()}}
            </div>
        </div>
    </div>
@endsection
