@extends('layout.master')

@section('content')
    <div class="container my-4">
        <div class="position-relative">
            <a href="{{ route('assignmentDetailPage.view', ['assignment_id' => $assignment->id]) }}" class="position-absolute" style="left: 0;">
                <img src="{{ asset('images/BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
        </div>

        <h4 class="text-center mb-4">{{$assignment->course->name}}</h4>

        @if (session('success'))
            <div class="alert alert-success mt-3 mx-2">{{ session('success') }}</div>
        @endif

        <div class="container p-4 my-4" style="border: 2px solid black; border-radius: 10px;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-2">
                    <h2>{{$assignment->title}} Submission</h2>
                    @if (Auth::check() && Auth::user()->role_id == 3)
                        <a href="{{ route('editAssignmentPage.view', ['assignment_id' => $assignment->id]) }}">
                            <img src="{{ asset('images/EditIcon.png') }}" alt="Edit Icon" width="20px">
                        </a>
                    @endif
                </div>

                @if ($assignment->status == "On Going")
                    <span class="badge bg-success text-white py-2 px-3 rounded-pill">{{$assignment->status}}</span>
                @elseif ($assignment->status == "Expired")
                    <span class="badge bg-danger text-white py-2 px-3 rounded-pill">{{$assignment->status}}</span>
                @endif
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <h5>Start Date</h5>
                    <p class="text-muted">{{$assignment->start_date->format('j F Y')}}</p>
                </div>
                <div class="col-6">
                    <h5>End Date</h5>
                    <p class="text-muted">{{$assignment->due_date->format('j F Y')}}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <h5>Attempts</h5>
                    <p class="text-muted">
                        @if ($assignment->attempts)
                            {{$submission ? $submission->attempt_number + 1 : 1}} of {{$assignment->attempts}}
                        @else
                            {{$submission ? $submission->attempt_number + 1 : 1}} of Unlimited
                        @endif
                    </p>
                </div>

                @if (Auth::check() && Auth::user()->role_id == 3)
                    <div class="col-6">
                        <h5>Total Submissions</h5>
                        <p class="text-muted">{{ count($assignment->submissions) ?: 0 }}</p>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <div class="col">
                    <h5>Question</h5>
                    <div class="d-flex justify-content-between p-3 mb-2" style="border-radius: 10px; background-color: rgb(242, 239, 239)">
                        <h6>{{ $file_name }}</h6>
                        <a href="{{ route('assignment.download', ['assignment_id' => $assignment->id]) }}">
                            <img src="{{ asset('images/DownloadIcon.png') }}" alt="Download Icon" width="30px">
                        </a>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <h5>Answer</h5>
                    <form action="{{ route('submissionPage.submit', ['assignment_id' => $assignment->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="submission" class="form-label">Upload Your Submission</label>
                            <input type="file" class="form-control" name="submission" id="submission">
                            @error('submission')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit Assignment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('component.WhiteSpace')
@endsection
