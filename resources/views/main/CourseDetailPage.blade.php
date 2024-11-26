@extends('layout.master')
@section('content')
    <div class="container my-2">
        {{-- Judul --}}
        <div class="position-relative">
            {{-- UBAH ROUTE KE COURSES PAGE --}}
            <a href="{{ route('homePage.view') }}" style="left: 0;">
                <img src="{{ asset('BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
        </div>
        <h4>{{$course->name}}</h4>
        {{-- Lecturer --}}
        <div class="fs-5 d-inline-flex">
            @if ($course->lecturer->photo)
                <img src="{{ asset($course->lecturer->photo) }}" alt="Lecturer's photo" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;" class="me-3">
            @else
                <img src="{{ asset('EmptyProfile.png') }}" alt="Default profile picture" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;" class="me-3">
            @endif    
            <div class="d-flex flex-column">
                <span class="fw-semibold">{{$course->lecturer->name}}</span>
                <small class="text-muted">Lecturer</small>
            </div>
        </div>
        {{-- Course Tabs --}}
        @include('component.CourseTabs', ['course' => $course])
        {{-- Topic Tab --}}
        @if (request()->routeIs('courseDetailPage.view'))
            @include('component.TopicsTabs', ['topics' => $course->topics, 'course' => $course])
            @include('component.TopicDetailTab', ['topic' => $topic])
        @endif
        {{-- Assignment Tab --}}
        @if (request()->routeIs('courseDetailPage.assignment'))
            @include('component.AssignmentCard', ['assignments' => $assignments])
        @endif
        {{-- Student Tab --}}
        @if (request()->routeIs('courseDetailPage.student'))
            @include('component.StudentList', ['students' => $students])
        @endif
    </div>
@endsection