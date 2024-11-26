@extends('layout.master')
@section('content')
    <div class="container my-2">
        @if (Auth::check())
            @if (Auth::user()->role_id == 1)
                {{-- show all course --}}
                @include('component.CourseCard', ['courses' => $allCourses])
                {{$allCourses->links()}}
            @elseif (Auth::user()->role_id == 2)
                <div class="d-flex flex-column gap-4">
                    <div class="container">
                        {{-- show all course --}}
                        <h4>All Courses</h4>
                        @include('component.CourseCard', ['courses' => $allCourses])
                        {{$allCourses->links()}}
                    </div>
                </div>
            @endif
        @else
            <h5 class="text-end">Welcome to Kursus Online!</h5>
            @include('component.CourseCard', ['courses' => $allCourses])
            <div class="my-1">
                {{$allCourses->links()}}
            </div>
        @endif
    </div>
@endsection