@extends('layout.master')
@section('content')
    <div class="container my-2">
        <div class="container">
            @include('component.CourseCard', ['courses' => $allCourses])
            <div class="my-1">
                {{$allCourses->links()}}
            </div>
        </div>
    </div>
@endsection