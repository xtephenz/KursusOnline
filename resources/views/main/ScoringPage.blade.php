@extends('layout.master')
@section('content')
    <div class="container mb-3 mt-4" style="width: 450px; border: 2px solid black; border-radius: 10px">
        <div class="position-relative">
            <a href="{{ route('assignmentDetailPage.view', ['assignment_id' => $submission->assignment->id]) }}" class="position-absolute" style="left: 0;">
                <img src="{{ asset('BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
        </div>
        <h4 class="text-center mt-2">Score Submission</h4>
        <form class="p-3" action="{{ route('scoringPage.score', ['submission_id' => $submission->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- Student --}}
            <div class="mb-3">
                <label for="student" class="form-label">Student</label>
                <input type="text" class="form-control" name="student" id="student" value="{{$submission->student->name}}" readonly>
            </div>
            {{-- Submission --}}
            <div class="mb-3">
                <label for="" class="form-label">Submission</label>
                <div class="d-flex flex-row justify-content-between align-items-center p-3 mb-2" style="border-radius: 10px; background-color: rgb(242, 239, 239)">
                    <h6>{{substr($file_name, 0, 35)}}</h6>
                    <a href=""><img src="{{ asset('DownloadIcon.png') }}" alt="" width="30px"></a>
                </div>
            </div>
            {{-- Submit Date --}}
            <div class="mb-3">
                <label for="submit_date" class="form-label">Submit Date</label>
                <input type="date" class="form-control" name="submit_date" id="submit_date" value="{{$submission->submit_date->format('Y-m-d')}}" readonly>
                @error('start')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            {{-- Score --}}
            <div class="mb-3">
                <label for="score" class="form-label">Score</label>
                <input type="number" class="form-control" name="score" id="score" value="{{ old('score', $submission->score ?? '') }}">
                @error('score')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-primary">Score Submission</button>
            </div>
        </form>
    </div>
    @include('component.WhiteSpace')
@endsection