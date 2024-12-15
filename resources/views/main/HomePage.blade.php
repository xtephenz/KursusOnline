@extends('layout.master')
@section('content')
    <div class="container my-4">
        <!-- Welcome Message -->
        <div class="text-end mb-4">
            @if(Auth::check())
                <h5>Welcome, {{ Auth::user()->name }}</h5>
            @else

            @endif
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero bg-primary text-white py-5">
        <div class="container text-center">
            <h1 class="display-4">Welcome to Kursus Online!</h1>
            <p class="lead">Discover the best online courses and grow your skills with expert instructors.</p>
            <div class="mt-4">
                @if(Auth::check())
                    @if(Auth::user()->role_id == 2)
                    <a href="{{ route('coursesPage.view') }}" class="btn btn-light btn-lg">Explore Your Courses</a>
                    @endif
                    @if(Auth::user()->role_id == 1)
                    @endif
                @else
                    <a href="{{ route('loginPage.view') }}" class="btn btn-light btn-lg">Get Started</a>
                @endif
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container my-4 pb-3">
        <!-- Display Courses Based on Role -->
        @if(Auth::check())
            @if(Auth::user()->role_id == 2)
                <!-- User Enrolled Courses -->
                <div class="d-flex flex-column gap-4">
                    @if($finishedCourses->isNotEmpty())
                        <div class="mb-4">
                            <h4>Finished Courses</h4>
                            @include('component.FinishedCourseCard', ['courses' => $finishedCourses])
                        </div>
                    @endif
                    @if($finishedCourses->isEmpty())
                        <div class="mb-4">
                            <h4>Finished Courses</h4>
                            <p>No Finished Courses Yet...</p>
                        </div>
                    @endif
                    @if($activeCourses->isNotEmpty())
                        <div class="mb-4">
                            <h4>Active Courses</h4>
                            @include('component.ActiveCourseCard', ['courses' => $activeCourses])
                        </div>
                    @endif
                    @if($activeCourses->isEmpty())
                        <div class="mb-4">
                            <h4>Active Courses</h4>
                            <p>No Active Courses Yet...</p>
                        </div>
                    @endif
                </div>
            @elseif(Auth::user()->role_id == 3)
                <!-- Instructor Taught Courses -->
                <div class="mb-4">
                    <h4>Taught Courses</h4>
                    <br>
                    @include('component.TaughtCourseCard', ['courses' => $taughtCourses])
                </div>
            @endif
        @else
            <!-- General Courses -->
            <div class="mb-4">
                <h4>All Courses</h4>
                @include('component.CourseCard', ['courses' => $allCourses])
            </div>
            @if($allCourses->hasMorePages())
                <div class="text-center">
                    <a href="{{ route('coursesPage.view') }}" class="text">Show More</a>
                </div>
            @endif
        @endif
    </div>
@endsection
