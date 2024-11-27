@extends('layout.master')
@section('content')
    <div class="container my-2">
        {{-- Add Hero Section --}}
        @if (Auth::check())
            @if (Auth::user()->role_id == 2)
                <div class="d-flex flex-column gap-4">
                    @if ($enrolledCourses->isNotEmpty())
                        <div class="container">
                            {{-- show course that is enrolled --}}
                            <h4>Enrolled Courses</h4>
                            @include('component.EnrolledCourseCard', ['courses' => $enrolledCourses])
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
@endsection