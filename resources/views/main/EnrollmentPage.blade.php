@extends('layout.master')
@section('content')
    <div class="container mb-5 mt-4" style="max-width: 520px; border: 2px solid #ddd; border-radius: 12px; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);">
        <div class="position-relative">
            <a href="{{ url()->previous() }}" class="position-absolute" style="left: 0; top: 10px;">
                <img src="{{ asset('images/BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
            <h4 class="text-center py-3">{{ $course->name }}</h4>
        </div>

        @if (session('fail'))
            <div class="alert alert-danger mt-3 mx-3">{{ session('fail') }}</div>
        @endif

        <table class="table table-borderless">
            <tbody>
                <!-- Lecturer Information -->
                <tr>
                    <td class="d-flex justify-content-center">
                        <div class="fs-5 d-inline-flex align-items-center">
                            @if ($course->lecturer->photo)
                                <img src="{{ asset($course->lecturer->photo) }}" alt="Lecturer's photo"
                                     class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" />
                            @else
                                <img src="{{ asset('images/EmptyProfile.png') }}" alt="Default profile picture"
                                     class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" />
                            @endif
                            <div class="d-flex flex-column ms-3">
                                <span class="fw-semibold">{{ $course->lecturer->name }}</span>
                                <small class="text-muted">Lecturer</small>
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- Topics Section -->
                <tr>
                    <td>
                        <h5 class="text-center mt-3">Topics</h5>
                    </td>
                </tr>
                <tr>
                    <td class="fs-5 d-flex justify-content-center">
                        @if ($course->topics->isNotEmpty())
                            <ul class="list-unstyled">
                                @foreach ($course->topics as $index => $topic)
                                    <li>{{ $index + 1 }}. {{ $topic->title }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted">TBA</span>
                        @endif
                    </td>
                </tr>

                <!-- Enroll Button -->
                @if (!Auth::check() || Auth::user()->role_id == 2)
                    <tr class="d-flex justify-content-center">
                        <td class="py-3">
                            <form action="{{ route('enrollmentPage.enroll', $course->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-hover">Enroll Course</button>
                            </form>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

@endsection
