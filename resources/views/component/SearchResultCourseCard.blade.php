<div class="container my-4">

    <!-- Course Card Grid -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        @foreach ($courses as $course)
            <div class="col">
                <div class="card h-100 shadow-sm course-card">
                    <div class="card-body d-flex flex-column gap-3">
                        <!-- Course Name -->
                        <h5 class="card-title text-center">{{ $course->name }}</h5>

                        <!-- Lecturer Information -->
                        <div class="d-flex align-items-center gap-3">
                            @if ($course->lecturer->photo)
                                <img src="{{ Storage::disk('s3')->url($course->lecturer->photo) }}"
                                     alt="Lecturer"
                                     class="rounded-circle shadow-sm"
                                     style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/EmptyProfile.png') }}"
                                     alt="Default profile"
                                     class="rounded-circle shadow-sm"
                                     style="width: 60px; height: 60px; object-fit: cover;">
                            @endif
                            <div>
                                <p class="fw-semibold mb-0">{{ $course->lecturer->name }}</p>
                                <p class="text-muted mb-0">Lecturer</p>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="mt-auto">
                            @if ((Auth::check() && Auth::user()->role_id == 2 && Auth::user()->enrollments->where('course_id', $course->id)->first()) || (Auth::check() && Auth::user()->role_id == 1))
                                @if (Auth::user()->enrollments->where('course_id', $course->id)->where('status', 'Finished')->first())
                                    <a href="{{ route('finalScorePage.view', $course->id) }}" class="btn btn-outline-primary w-100">View Final Score</a>
                                @else
                                    <a href="{{ route('courseDetailPage.view', $course->id) }}" class="btn btn-outline-primary w-100">View Course</a>
                                @endif
                            @else
                                <a href="{{ route('enrollmentPage.view', $course->id) }}" class="btn btn-outline-primary w-100">Show Details...</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
