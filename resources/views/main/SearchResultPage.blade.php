@extends('layout.master')

@section('content')
    <div class="container my-4">
        @if ($allCourses->isNotEmpty())
            <h4 class="text-center mb-4">Courses related to: <strong>"{{ $query }}"</strong></h4>
            <div class="row">
                @include('component.SearchResultCourseCard', ['courses' => $allCourses])
            </div>
            <div class="my-3">
                {{-- Pagination links with custom query handling --}}
                {{ $allCourses->appends(['query' => request()->input('query')])->links() }}
            </div>
        @else
            <h4 class="text-center text-muted">Sorry, we couldn't find any courses related to: <strong>"{{ $query }}"</strong></h4>
        @endif
    </div>
@endsection
