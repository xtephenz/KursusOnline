@extends('layout.master')
@section('content')
    <div class="container mb-3 mt-4" style="width: 500px; border: 2px solid black; border-radius: 10px">
        <div class="position-relative">
            <a href="{{ route('homePage.view') }}" class="position-absolute" style="left: 0;">
                <img src="{{ asset('images/BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
        </div>
        <h4 class="text-center mt-2">Final Score</h4>
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
            <input type="number" class="form-control" name="score" id="score" value="{{$enrollment->final_score}}" readonly>
            @error('score')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
    </div>
    @include('component.WhiteSpace')
@endsection