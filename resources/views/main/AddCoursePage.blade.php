@extends('layout.master')
@section('content')
    <div class="container mb-3 mt-4" style="width: 450px; border: 2px solid black; border-radius: 10px">
        <h4 class="text-center mt-2">Add New Course</h4>
        <form class="p-3" action="{{ route('addCoursePage.add') }}" method="post">
            @csrf
            {{-- Course Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Course Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="" value="{{old('name')}}" >
                @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            {{-- Lecturer --}}
            <div class="mb-3">
                <label for="lecturer" class="form-label">Lecturer</label>
                <select name="lecturer" id="lecturer" class="form-select" aria-label="Default select example">
                    {{-- <option value="">-- Select a Lecturer --</option> --}}
                    @foreach ($lecturers as $lecturer)
                        <option value="{{$lecturer->id}}" {{ old('lecturer') == $lecturer->id ? 'selected' : '' }}>{{$lecturer->name}}</option>
                    @endforeach
                </select>
                @error('lecturer')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>            
            {{-- Topics --}}
            <div class="mb-3">
                <label class="form-label">Topics</label>
                @foreach (old('topics', range(1, 1)) as $index => $topic)
                    <div class="mb-2">
                        <input type="text" class="form-control" name="topics[]" placeholder="Topic {{$index + 1}}" value="{{is_string($topic) ? $topic : ''}}">
                    </div>
                    @error('topics.'.$index)
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                @endforeach
                <button type="submit" name="add_topic" value="1" class="btn btn-secondary mt-2">Add Topic</button>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-primary">Add Course</button>
            </div>   
        </form>
    </div>
    @for ($i = 0; $i < 15; $i++)
        <br>
    @endfor
@endsection