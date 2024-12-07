@extends('layout.master')
@section('content')
    <div class="container mb-3 mt-4" style="width: 450px; border: 2px solid black; border-radius: 10px">
        <div class="position-relative">
            <a href="{{ route('assignmentDetailPage.view', ['assignment_id' => $assignment->id]) }}" class="position-absolute" style="left: 0;">
                <img src="{{ asset('images/BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
        </div>
        <h4 class="text-center mt-2">Edit Assignment</h4>
        <form class="p-3" action="" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- Course --}}
            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" class="form-control" name="course" id="course" value="{{$assignment->course->name}}" readonly>
            </div>
            {{-- Title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Top Down Parsing" value="{{$assignment->title}}" >
                @error('title')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Current Assignment</label>
                <div class="d-flex flex-row justify-content-between p-3 mb-2" style="max-width: 300px; border-radius: 10px; background-color: rgb(242, 239, 239)">
                    <h6>{{$file_name}}</h6>
                    <a href="{{ route('assignment.download', ['assignment_id' => $assignment->id]) }}"><img src="{{ asset('images/DownloadIcon.png') }}" alt="" width="30px"></a>
                </div>
            </div>
            {{-- Assignment File --}}
            <div class="mb-3">
                <label for="assignment" class="form-label">Assignment</label>
                <input type="file" class="form-control" name="assignment" id="assignment" >
                @error('assignment')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div> 
            {{-- Attempts --}}
            <div class="mb-3">
                <label for="attempts" class="form-label">Attempts</label>
                <input type="number" class="form-control" name="attempts" id="attempts" value="{{$assignment->attempts ?? ''}}" >
                @error('attempts')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            {{-- Start Date --}}
            <div class="mb-3">
                <label for="start" class="form-label">Start Date</label>
                <input type="date" class="form-control" name="start" id="start" value="{{$assignment->start_date->format('Y-m-d')}}">
                @error('start')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            {{-- Due Date --}}
            <div class="mb-3">
                <label for="due" class="form-label">Due Date</label>
                <input type="date" class="form-control" name="due" id="due" value="{{$assignment->due_date->format('Y-m-d')}}">
                @error('due')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-primary">Update Assignment</button>
            </div>
        </form>
    </div>
    @include('component.WhiteSpace')
@endsection