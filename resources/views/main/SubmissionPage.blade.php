@extends('layout.master')
@section('content')
    <div class="container my-2">
        <div class="position-relative">
            <a href="{{ route('assignmentDetailPage.view', ['assignment_id' => $assignment->id]) }}" style="left: 0;">
                <img src="{{ asset('images/BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
        </div>
        <h4>{{$assignment->course->name}}</h4>
        @if (session('success'))
            <div class="alert alert-success mt-3 mx-2">{{session('success')}}</div>
        @endif
        <div class="container d-flex flex-column my-4 gap-3" style="border: 2px solid black; border-radius: 10px; width: 100%;">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <h2>{{$assignment->title}} Submission</h2>
                    @if (Auth::check() && Auth::user()->role_id == 3)
                        <a href="{{ route('editAssignmentPage.view', ['assignment_id' => $assignment->id]) }}"><img src="{{ asset('images/EditIcon.png') }}" alt="" width="20px"></a>
                    @endif
                </div>
                @if ($assignment->status == "On Going")
                    <h1 class="btn mt-2" style="width: 100px; background-color: rgb(61, 155, 93); color:white; font-weight: 500; border-radius: 20px;">{{$assignment->status}}</h1>
                @elseif ($assignment->status == "Expired")
                    <h1 class="btn mt-2" style="width: 100px; background-color: rgb(203, 45, 45); color:white; font-weight: 500; border-radius: 20px;">{{$assignment->status}}</h1>
                @endif
            </div>
            <div class="row">
                <div class="col-6">
                    <h5>Start</h5>
                    <h6 class="text-muted">{{$assignment->start_date->format('j F Y')}}</h6>
                </div>
                <div class="col-6">
                    <h5>End</h5>
                    <h6 class="text-muted">{{$assignment->due_date->format('j F Y')}}</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <h5>Attempts</h5>
                    @if ($assignment->attempts != null)
                        @if ($submission == null)
                            <h6 class="text-muted">1 of {{$assignment->attempts}}</h6>
                        @else
                            <h6 class="text-muted">{{$submission->attempt_number+1}} of {{$assignment->attempts}}</h6>    
                        @endif
                    @else
                        @if ($submission == null)
                            <h6 class="text-muted">1 of Unlimited</h6>
                        @else
                            <h6 class="text-muted">{{$submission->attempt_number+1}} of Unlimited</h6>    
                        @endif
                    @endif
                </div>
                @if (Auth::check() && Auth::user()->role_id == 3)
                    <div class="col-6">
                        <h5>Total Submission</h5>
                        @if ($assignment->submissions->isNotEmpty())
                            <h6 class="text-muted">{{count($assignment->attempts)}}</h6>
                        @else
                            <h6 class="text-muted">0</h6> 
                        @endif
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col">
                    <h5>Question</h5>
                    <div class="d-flex flex-row justify-content-between p-3 mb-2" style="max-width: 300px; border-radius: 10px; background-color: rgb(242, 239, 239)">
                        <h6>{{$file_name}}</h6>
                        <a href="{{ route('assignment.download', ['assignment_id' => $assignment->id]) }}"><img src="{{ asset('images/DownloadIcon.png') }}" alt="" width="30px"></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h5>Answer</h5>
                    <form action="{{ route('submissionPage.submit', ['assignment_id' => $assignment->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- Submission File --}}
                        <div class="mb-3">
                            <input type="file" class="form-control" name="submission" id="submission">
                            @error('submission')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end mb-3">
                            <button type="submit" class="btn btn-primary">Submit Assignment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('component.WhiteSpace')
@endsection