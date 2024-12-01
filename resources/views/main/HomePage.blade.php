@extends('layout.master')
@section('content')
    <div class="container my-2">
        @if(Auth::check())
            <h5 class="text-end">Welcome, {{ Auth::user()->name }}</h5>
        @else
            <h5 class="text-end">Welcome to Kursus Online!</h5>
        @endif
        {{-- Add Hero Section --}}
        @if (Auth::check())
            @if (Auth::user()->role_id == 2)
                <div class="d-flex flex-column gap-4">
                    @if ($finishedCourses->isNotEmpty())
                        <div class="container">
                            {{-- show course that is enrolled --}}
                            <h4>Finished Courses</h4>
                            @include('component.FinishedCourseCard', ['courses' => $finishedCourses])
                        </div>
                    @endif
                    @if ($activeCourses->isNotEmpty())
                        <div class="container">
                            {{-- show course that is enrolled --}}
                            <h4>Active Courses</h4>
                            @include('component.ActiveCourseCard', ['courses' => $activeCourses])
                        </div>
                    @endif
                </div>
            @elseif (Auth::user()->role_id == 3)
                <div class="container">
                    {{-- show course that is taught --}}
                    <h4>Taught Courses</h4>
                    @include('component.TaughtCourseCard', ['courses' => $taughtCourses])
                </div>
            @endif
        @else
            <div class="container">
                {{-- show all course --}}
                <h4>All Courses</h4>
                @include('component.CourseCard', ['courses' => $allCourses])
                @if($allCourses->hasMorePages())
                    <div class="text-center p-3">
                        <a href="{{ route('coursesPage.view') }}" class="btn btn-primary">Show More</a>
                    </div>
                @else
                    <div class="text-center p-3">
                        <a href="{{ route('coursesPage.view') }}" class="btn btn-primary">Show More</a>
                    </div>
                @endif
            </div>
        @endif
    </div>
    @include('component.WhiteSpace')
    @include('component.WhiteSpace')
@endsection