<div class="container d-flex flex-column align-items-center gap-4">
    @php
        $coursesPerRow = 3;
    @endphp
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($courses as $course)
            <div class="col">
                <div class="card h-100 shadow-sm course-card">
                    <div class="card-body d-flex flex-column gap-3">
                        <!-- Course Name -->
                        <h5 class="card-title">{{ $course->name }}</h5>

                        <!-- Lecturer Information -->
                        <div class="d-flex align-items-center gap-3">
                            @if ($course->lecturer->photo)
                                <img src="{{ asset($course->lecturer->photo) }}" alt="Lecturer's photo"
                                     class="rounded-circle shadow-sm" style="width: 70px; height: 70px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/EmptyProfile.png') }}" alt="Default profile picture"
                                     class="rounded-circle shadow-sm" style="width: 70px; height: 70px; object-fit: cover;">
                            @endif
                            <div>
                                <div class="fw-semibold">{{ $course->lecturer->name }}</div>
                                <div class="text-muted">Lecturer</div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="mt-2">
                            <a href="{{ route('courseDetailPage.view', $course->id) }}" class="btn btn-primary btn-hover">
                                View Course
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
