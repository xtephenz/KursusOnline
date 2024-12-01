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