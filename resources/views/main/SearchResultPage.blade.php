@extends('layout.master')
@section('content')
    <div class="container my-2">
        @if ($allCourses->isNotEmpty())
            <h4>"Course related to: {{$query}}"</h4>
            <div class="container">
                @include('component.CourseCard', ['courses' => $allCourses])
                <div class="my-1">
                    {{ $allCourses->appends(['query' => request()->input('query')])->links() }}
                </div>
            </div>
        @else
            <h4>"Sorry, we couldn't find any courses related to: {{$query}}"</h4>
        @endif
    </div>
@endsection