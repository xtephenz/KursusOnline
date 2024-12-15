@extends('layout.master')

@section('content')
    <div class="container mb-3 mt-4" style="max-width: 500px; border: 2px solid #ddd; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
        <div class="position-relative">
            <a href="{{ route('assignmentDetailPage.view', ['assignment_id' => $submission->assignment->id]) }}" class="position-absolute" style="left: 0; top: 10px;">
                <img src="{{ asset('images/BackArrow.png') }}" alt="Back Arrow" style="width: 25px; cursor: pointer;">
            </a>
        </div>
        <h4 class="text-center mt-3 mb-4">Score Submission</h4>

        <form class="p-4" action="{{ route('scoringPage.score', ['submission_id' => $submission->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Student --}}
            <div class="mb-3">
                <label for="student" class="form-label">Student</label>
                <input type="text" class="form-control" name="student" id="student" value="{{$submission->student->name}}" readonly>
            </div>

            {{-- Submission File --}}
            <div class="mb-3">
                <label for="" class="form-label">Submission</label>
                <div class="d-flex justify-content-between align-items-center p-3 mb-2" style="border-radius: 10px; background-color: rgb(242, 239, 239)">
                    <h6 class="text-truncate" style="max-width: 70%;">{{substr($file_name, 0, 35)}}</h6>
                    <!-- Removed the download link changes here -->
                    <a href="{{ route('submission.download', ['submission_id' => $submission->id]) }}"><img src="{{ asset('images/DownloadIcon.png') }}" alt="Download" width="30px"></a>
                </div>
            </div>

            {{-- Submit Date --}}
            <div class="mb-3">
                <label for="submit_date" class="form-label">Submit Date</label>
                <input type="date" class="form-control" name="submit_date" id="submit_date" value="{{$submission->submit_date->format('Y-m-d')}}" readonly>
                @error('start')
                    <div class="text-danger mt-1">{{$message}}</div>
                @enderror
            </div>

            {{-- Score --}}
            <div class="mb-3">
                <label for="score" class="form-label">Score</label>
                <input type="number" class="form-control" name="score" id="score" value="{{ old('score', $submission->score ?? '') }}" min="0" max="100" step="0.1">
                @error('score')
                    <div class="text-danger mt-1">{{$message}}</div>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-primary w-100">Submit Score</button>
            </div>
        </form>
    </div>
@endsection
