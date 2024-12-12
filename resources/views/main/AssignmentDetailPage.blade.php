@extends('layout.master')

@section('content')
    <div class="container my-2">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Back Button -->
            <a href="{{ route('courseDetailPage.assignment', ['course_id' => $assignment->course->id]) }}">
                <img src="{{ asset('images/BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
    
            <h4>{{ $assignment->course->name }}</h4>
        </div>
        @if (session('success'))
            <div class="alert alert-success mt-3 mx-2">{{ session('success') }}</div>
        @endif
        <div class="container d-flex flex-column my-4 gap-3" style="border: 2px solid black; border-radius: 10px; width: 100%;">
            <!-- Assignment Title and Actions -->
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <h2>{{ $assignment->title }}</h2>

                    @if (Auth::check() && Auth::user()->role_id == 3) <!-- Admin Role -->
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('editAssignmentPage.view', ['assignment_id' => $assignment->id]) }}">
                                <img src="{{ asset('images/EditIcon.png') }}" alt="Edit" width="30px">
                            </a>
                            <button type="submit" style="border: none; background: none; padding: 0;" data-bs-toggle="modal" data-bs-target="#deleteAssignmentModal">
                                <img src="{{ asset('images/DeleteIcon.png') }}" alt="Delete Icon" width="30px">
                            </button>

                            <!-- Modal for Deletion -->
                            <div class="modal fade" id="deleteAssignmentModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this assignment?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('assignment.delete', ['assignment_id' => $assignment->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Assignment Status -->
                <div class="d-flex align-items-center">
                    @switch($assignment->status)
                        @case('On Going')
                            <h1 class="btn mt-2" style="background-color: rgb(61, 155, 93); color:white; font-weight: 500; border-radius: 20px;">
                                {{ $assignment->status }}
                            </h1>
                            @break
                        @case('Expired')
                            <h1 class="btn mt-2" style="background-color: rgb(203, 45, 45); color:white; font-weight: 500; border-radius: 20px;">
                                {{ $assignment->status }}
                            </h1>
                            @break
                        @case('Coming Soon')
                            <h1 class="btn mt-2" style="background-color: rgb(220, 170, 32); color:white; font-weight: 500; border-radius: 20px;">
                                {{ $assignment->status }}
                            </h1>
                            @break
                    @endswitch
                </div>
            </div>

            <!-- Assignment Dates -->
            <div class="row">
                <div class="col-6">
                    <h5>Start</h5>
                    <h6 class="text-muted">{{ $assignment->start_date->format('j F Y') }}</h6>
                </div>
                <div class="col-6">
                    <h5>End</h5>
                    <h6 class="text-muted">{{ $assignment->due_date->format('j F Y') }}</h6>
                </div>
            </div>

            <!-- Attempts Information -->
            <div class="row">
                <div class="col-6">
                    <h5>Attempts</h5>
                    <h6 class="text-muted">
                        @if (Auth::user()->role_id != 2)
                            {{ $assignment->attempts ? $assignment->attempts : 'Unlimited' }}
                        @else
                            @if ($assignment->attempts)
                                {{ $submission ? $submission->attempt_number . ' of ' . $assignment->attempts : '0 of ' . $assignment->attempts }}
                            @else
                                {{ $submission ? $submission->attempt_number . ' of Unlimited' : '0 of Unlimited' }}
                            @endif
                        @endif
                    </h6>
                </div>

                <!-- Total Submission (Admin) -->
                @if (Auth::check() && Auth::user()->role_id == 3)
                    <div class="col-6">
                        <h5>Total Submissions</h5>
                        <h6 class="text-muted">{{ count($assignment->submissions) ?? '0' }}</h6>
                    </div>
                @endif
            </div>

            <!-- Assignment File Download -->
            <div class="row">
                <div class="col">
                    <h5>Question</h5>
                    <div class="d-flex flex-row justify-content-between p-3 mb-2" style="max-width: 300px; border-radius: 10px; background-color: rgb(242, 239, 239)">
                        <h6>{{ $file_name }}</h6>
                        <a href="{{ route('assignment.download', ['assignment_id' => $assignment->id]) }}">
                            <img src="{{ asset('images/DownloadIcon.png') }}" alt="Download" width="30px">
                        </a>
                    </div>
                </div>
            </div>

            <!-- Submission Button (Student) -->
            @if (Auth::check() && Auth::user()->role_id == 2)
                <hr>
                <div class="d-flex justify-content-end">
                    @switch($assignment->status)
                        @case('On Going')
                            <a href="{{ route('submissionPage.view', ['assignment_id' => $assignment->id]) }}" class="btn btn-primary mb-3">
                                Start Attempt ({{ $submission ? $submission->attempt_number + 1 : '1' }})
                            </a>
                            @break
                        @case('Expired')
                            <a href="#" class="btn btn-primary disabled mb-3" aria-disabled="true">Start Attempt ({{ $submission ? $submission->attempt_number + 1 : '1' }})</a>
                            @break
                        @case('Coming Soon')
                            <a href="#" class="btn btn-primary disabled mb-3" aria-disabled="true">Start Attempt (1)</a>
                            @break
                    @endswitch
                </div>
            @endif
        </div>
    </div>

    <!-- Submission Lists (Admin) -->
    @if (Auth::check() && Auth::user()->role_id == 3)
        @include('component.SubmissionList', ['submissions' => $submissions])
    @elseif (Auth::check() && Auth::user()->role_id == 2 && $submission != null)
        @include('component.SubmissionHistory', ['submission' => $submission])
    @endif
@endsection
