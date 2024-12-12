@extends('layout.master')

@section('content')
    <div class="container my-4" style="max-width: 450px; border: 2px solid black; border-radius: 10px; padding: 20px;">
        <div class="position-relative mb-3">
            <a href="{{ route('courseDetailPage.view', ['course_id' => $topic->course->id, 'topic_id' => $topic->id]) }}" class="position-absolute" style="left: 0; top: -10px;">
                <img src="{{ asset('images/BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
        </div>

        <h4 class="text-center mb-3">Edit Topic</h4>

        <form action="{{ route('editTopicPage.update', ['topic_id' => $topic->id]) }}" method="post">
            @csrf
            @method('PUT')

            {{-- Course --}}
            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" class="form-control" name="course" id="course" value="{{ $topic->course->name }}" readonly>
            </div>

            {{-- Topic Title --}}
            <div class="mb-3">
                <label for="topic" class="form-label">Topic Title</label>
                <input type="text" class="form-control" name="topic" id="topic" value="{{ old('topic', $topic->title) }}" placeholder="Enter topic title">
                @error('topic')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-primary w-100">Update Topic</button>
            </div>
        </form>
    </div>
@endsection
