@extends('layout.master')
@section('content')
    <div class="container mb-3 mt-4" style="width: 500px; border: 2px solid black; border-radius: 10px">
        <div class="position-relative">
            <a href="{{ route('courseDetailPage.student', ['course_id' => $enrollment->course->id]) }}" class="position-absolute" style="left: 0;">
                <img src="{{ asset('images/BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
        </div>
        <h4 class="text-center mt-2">Final Score Submission</h4>
        <form class="p-3" action="" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- Course --}}
            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" class="form-control" name="course" id="course" value="{{$enrollment->course->name}}" readonly>
            </div>
            {{-- Student --}}
            <div class="mb-3">
                <label for="student" class="form-label">Student</label>
                <input type="text" class="form-control" name="student" id="student" value="{{$enrollment->student->name}}" readonly>
            </div>
            {{-- Submission --}}
            <div class="mb-3">
                <label for="" class="form-label">Submission List</label>
                <table class="table">
                    <tbody>
                        @for ($i = 0; $i < count($submissions); $i++)
                            <tr>
                                <td>{{$i+1}}.</td>
                                <td>{{$submissions[$i]->assignment->title}}</td>
                                <td>
                                    @if ($submissions[$i]->score != null)
                                        {{$submissions[$i]->score}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            {{-- Score --}}
            <div class="mb-3">
                <label for="score" class="form-label">Score</label>
                <input type="number" class="form-control" name="score" id="score" value="{{$score}}" step="0.01">
                @error('score')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#submitFinalScoreModal">
                    Submit Final Score
                </button>
            </div>
            <div class="modal fade" id="submitFinalScoreModal" tabindex="-1" aria-labelledby="submitFinalScoreLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="submitFinalScoreLabel">Confirm Final Score Submission</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to submit the final score? The final score cannot be changed once submitted!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ route('finalScoreSubmissionPage.submit', ['course_id' => $enrollment->course->id, 'student_id' => $enrollment->student->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('component.WhiteSpace')
@endsection