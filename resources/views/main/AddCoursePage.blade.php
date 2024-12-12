@extends('layout.master')

@section('content')
    <div class="container my-4" style="max-width: 500px; border: 2px solid #ddd; border-radius: 12px; padding: 20px;">
        <div class="position-relative">
            <a href="{{ route('coursesPage.view') }}" class="position-absolute" style="left: 0; top: 0;">
                <img src="{{ asset('images/BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
        </div>

        <h4 class="text-center mb-4">Add New Course</h4>

        <form action="{{ route('addCoursePage.add') }}" method="post">
            @csrf
            {{-- Course Name --}}
            <div class="mb-4">
                <label for="name" class="form-label">Course Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Course Name" value="{{ old('name', $material->name ?? '') }}" required>
                @error('name')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Lecturer --}}
            <div class="mb-4">
                <label for="lecturer" class="form-label">Lecturer</label>
                <select name="lecturer" id="lecturer" class="form-select" required>
                    <option value="">-- Select a Lecturer --</option>
                    @foreach ($lecturers as $lecturer)
                        <option value="{{ $lecturer->id }}" {{ old('lecturer') == $lecturer->id ? 'selected' : '' }}>{{ $lecturer->name }}</option>
                    @endforeach
                </select>
                @error('lecturer')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Topics --}}
            <div class="mb-4">
                <label class="form-label">Topics</label>
                <div id="topics-container">
                    @foreach (old('topics', range(1, 1)) as $index => $topic)
                        <div class="topic-field mb-2">
                            <input type="text" class="form-control" name="topics[]" placeholder="Topic {{$index + 1}}" value="{{ is_string($topic) ? $topic : '' }}" required>
                            @error('topics.' . $index)
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-topic" class="btn btn-outline-secondary mt-2 w-100">Add Topic</button>
            </div>

            {{-- Submit Button --}}
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Add Course</button>
            </div>
        </form>
    </div>

    {{-- Optional Spacer --}}
    <div class="mt-5">
        @for ($i = 0; $i < 15; $i++)
            <br>
        @endfor
    </div>

    {{-- Script to Add Topics Dynamically --}}
    <script>
        document.getElementById('add-topic').addEventListener('click', function () {
            const topicsContainer = document.getElementById('topics-container');
            const topicCount = topicsContainer.children.length + 1;  // Get the next topic number
            const newTopicField = document.createElement('div');
            newTopicField.classList.add('topic-field', 'mb-2');
            newTopicField.innerHTML = `
                <input type="text" class="form-control" name="topics[]" placeholder="Topic ${topicCount}" required>
            `;
            topicsContainer.appendChild(newTopicField);
        });
    </script>
@endsection
