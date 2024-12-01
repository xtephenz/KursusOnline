@extends('layout.master')
@section('content')
    <div class="container mb-3 mt-4" style="width: 450px; border: 2px solid black; border-radius: 10px">
        <div class="position-relative">
            <a href="{{ route('courseDetailPage.view', ['course_id' => $topic->course->id, 'topic_id' => $topic->id]) }}" class="position-absolute" style="left: 0;">
                <img src="{{ asset('BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
        </div>
        <h4 class="text-center mt-2">Edit Topics</h4>
        <form class="p-3" action="{{ route('editTopicPage.update', ['topic_id' => $topic->id]) }}" method="post">
            @csrf
            @method('PUT')
            {{-- Course --}}
            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" class="form-control" name="course" id="course" value="{{$topic->course->name}}" readonly>
            </div>
            {{-- Topic --}}
            <div class="mb-3">
                <label for="topic" class="form-label">Title</label>
                <input type="text" class="form-control" name="topic" id="topic" value="{{$topic->title}}">
                @error('topic')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-primary">Update Topic</button>
            </div>
        </form>
    </div>
    @include('component.WhiteSpace')
@endsection