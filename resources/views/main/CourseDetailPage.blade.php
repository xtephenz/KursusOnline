@extends('layout.master')
@section('content')
    <div class="container my-4">
        {{-- Header Section --}}
        <div class="d-flex justify-content-between align-items-center">
            {{-- Back Button --}}
            <a href="{{ route('coursesPage.view') }}">
                <img src="{{ asset('images/BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
            {{-- Course Title & Admin Actions --}}
            <div class="d-flex align-items-center gap-3">
                <h4>{{ $course->name }}</h4>
                @if (Auth::check() && Auth::user()->role_id == 1)
                    <div class="d-flex align-items-center gap-2">
                        {{-- Edit Icon --}}
                        <a href="{{ route('editCoursePage.view', ['course_id' => $course->id]) }}">
                            <img src="{{ asset('images/EditIcon.png') }}" alt="Edit" width="30px">
                        </a>
                        {{-- Delete Icon & Modal --}}
                        <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#deleteCourseModal">
                            <img src="{{ asset('images/DeleteIcon.png') }}" alt="Delete" width="30px">
                        </button>

                        <div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this course?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('courseDetailPage.delete', ['course_id' => $course->id]) }}" method="POST" id="confirmDeleteForm">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="delete_action" id="deleteAction">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Success Message --}}
        @if (session('success-update'))
            <div class="alert alert-success mt-3 mx-2">{{ session('success-update') }}</div>
        @endif

        {{-- Lecturer Info --}}
        <div class="d-flex align-items-center gap-3 mb-4">
            @if ($course->lecturer->photo)
                <img src="{{ Storage::disk('s3')->url($course->lecturer->photo) }}" alt="Lecturer's photo" class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
            @else
                <img src="{{ asset('images/EmptyProfile.png') }}" alt="Default profile picture" class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
            @endif
            <div>
                <span class="fw-semibold">{{ $course->lecturer->name }}</span>
                <div class="text-muted">
                    <a href="mailto:{{ $course->lecturer->email }}">{{ $course->lecturer->email }}</a>
                </div>
                <small class="text-muted">Lecturer</small>
            </div>
        </div>

        {{-- Course Tabs --}}
        @include('component.CourseTabs', ['course' => $course])

        {{-- Topics Tab --}}
        @if (request()->routeIs('courseDetailPage.view'))
            @if (Auth::check() && Auth::user()->role_id == 1)
                <div class="d-flex justify-content-start my-3">
                    <a href="{{ route('addTopicPage.view', ['course_id' => $course->id]) }}" class="btn btn-outline-primary-green">Add New Topic</a>
                </div>
            @endif
            @if ($topic != null)
                @include('component.TopicsTabs', ['topics' => $course->topics, 'course' => $course])
                @include('component.TopicTabDetail', ['topic' => $topic])
            @else
                <h6 class="text-center text-muted">TBA</h6>
            @endif
        @endif

        {{-- Assignment Tab --}}
        @if (request()->routeIs('courseDetailPage.assignment'))
            @if (Auth::check() && Auth::user()->role_id == 3)
                <div class="d-flex justify-content-start my-3">
                    <a href="{{ route('addAssignmentPage.view', ['course_id' => $course->id]) }}" class="btn btn-primary">Add New Assignment</a>
                </div>
            @endif
            @if ($assignments->isNotEmpty())
                @include('component.AssignmentTabDetail', ['course' => $course, 'assignments' => $assignments])
            @else
                <h6 class="text-center text-muted">TBA</h6>
            @endif
        @endif

        {{-- Student Tab --}}
        @if (request()->routeIs('courseDetailPage.student'))
            @include('component.StudentTabDetail', ['course' => $course, 'activeStudents' => $activeStudents, 'finishedStudents' => $finishedStudents])
        @endif
    </div>
@endsection
