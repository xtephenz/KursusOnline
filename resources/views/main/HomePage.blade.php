@extends('layout.master')
@section('content')
    <div class="container-fluid">
        @if (Auth::check())
            <h5 class="text-end">Welcome, {{ Auth::user()->name }}</h5>
            @if (Auth::user()->role_id == 1)
                {{-- show all course --}}
                @include('component.CourseCard', ['courses' => $allCourses])
            @elseif (Auth::user()->role_id == 2)
                {{-- show course that is enrolled --}}
                {{-- show all course --}}
                @include('component.CourseCard', ['courses' => $allCourses])
                @if($allCourses->hasMorePages())
                    <div class="text-center p-3">
                        <a href="#" class="btn btn-primary">Show More</a>
                    </div>
                @endif
            @elseif (Auth::user()->role_id == 3)
                {{-- show course that is taught --}}
            @endif
        @else
            <h5 class="text-end">Welcome to Kursus Online!</h5>
            @include('component.CourseCard', ['courses' => $allCourses])
        @endif
    </div>
@endsection