@extends('layout.master')
@section('content')
    <div class="container mb-3 mt-4" style="width: 450px; border: 2px solid black; border-radius: 10px">
        <div class="position-relative">
            <a href="{{ route('courseDetailPage.view', ['course_id' => $course->id]) }}" class="position-absolute" style="left: 0;">
                <img src="{{ asset('BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
        </div>
        <h4 class="text-center mt-2">Add New Topics</h4>
        <form class="p-3" action="{{ route('addTopicPage.add', ['course_id' => $course->id]) }}" method="post">
            @csrf
            {{-- Course --}}
            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" class="form-control" name="course" id="course" value="{{$course->name}}" readonly>
            </div>
            {{-- Existing Topics --}}
            @if ($course->topics->isNotEmpty())
                <div class="mb-3">
                    <label class="form-label">Existing Topics</label>
                    @foreach ($course->topics as $index => $existingTopic)
                        <br>Topic {{ $index + 1 }}: {{ $existingTopic->title }}
                    @endforeach
                </div>
            @endif
            {{-- Add New Topics --}}
            <div class="mb-3">
                <label class="form-label">Add Topics</label>
                @php
                    $startIndex = $course->topics->count() + 1; // Start after existing topics
                @endphp
                @foreach (old('topics', range(1, 1)) as $index => $topic)
                    <div class="mb-2">
                        <input type="text" class="form-control" name="topics[]" placeholder="Topic {{ $startIndex + $index }}" value="{{ is_string($topic) ? $topic : '' }}">
                    </div>
                    @error('topics.' . $index)
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                @endforeach
                <button type="submit" name="add_topic" value="1" class="btn btn-secondary mt-2">Add Another Topic</button>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-primary">Add Topics</button>
            </div>
        </form>
    </div>
    @for ($i = 0; $i < 15; $i++)
        <br>
    @endfor
@endsection