@extends('layout.master')

@section('content')
    <div class="container mb-3 mt-4" style="max-width: 500px; border: 2px solid #ddd; border-radius: 12px; padding: 20px;">
        <div class="position-relative">
            <a href="{{ route('courseDetailPage.view', ['course_id' => $topic->course->id, 'topic_id' => $topic->id]) }}" class="position-absolute" style="left: 0; top: 0;">
                <img src="{{ asset('images/BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
        </div>

        <h4 class="text-center mb-4">Add New Material</h4>

        <form class="p-3" action="{{ route('addMaterialPage.add', ['topic_id' => $topic->id]) }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- Topic --}}
            <div class="mb-3">
                <label for="topic" class="form-label">Topic</label>
                <input type="text" class="form-control" name="topic" id="topic" value="{{$topic->title}}" readonly>
            </div>

            {{-- Title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Top Down Parsing Tutorial" value="{{ old('title') }}" required>
                @error('title')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Material File --}}
            <div class="mb-3">
                <label for="material" class="form-label">Material</label>
                <input type="file" class="form-control" name="material" id="material" required>
                @error('material')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary w-100">Add Material</button>
            </div>
        </form>
    </div>
@endsection
