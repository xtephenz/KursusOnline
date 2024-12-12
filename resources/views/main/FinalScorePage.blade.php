@extends('layout.master')

@section('content')
    <div class="container my-4" style="max-width: 500px; border: 2px solid black; border-radius: 10px; padding: 20px;">
        <div class="position-relative mb-3">
            <a href="{{ route('homePage.view') }}" class="position-absolute" style="left: 0; top: -10px;">
                <img src="{{ asset('images/BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
        </div>

        <h4 class="text-center mb-3">Final Score</h4>

        {{-- Course --}}
        <div class="mb-3">
            <label for="course" class="form-label">Course</label>
            <input type="text" class="form-control" name="course" id="course" value="{{ $enrollment->course->name }}" readonly>
        </div>

        {{-- Student --}}
        <div class="mb-3">
            <label for="student" class="form-label">Student</label>
            <input type="text" class="form-control" name="student" id="student" value="{{ $enrollment->student->name }}" readonly>
        </div>

        {{-- Submission List --}}
        <div class="mb-3">
            <label for="" class="form-label">Submission List</label>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Assignment Title</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($submissions as $index => $submission)
                        <tr>
                            <td>{{ $index + 1 }}.</td>
                            <td>{{ $submission->assignment->title }}</td>
                            <td>
                                @if ($submission->score !== null)
                                    {{ $submission->score }}
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Final Score --}}
        <div class="mb-3">
            <label for="score" class="form-label">Final Score</label>
            <input type="number" class="form-control" name="score" id="score" value="{{ $enrollment->final_score }}" readonly>
            @error('score')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
    </div>
@endsection
