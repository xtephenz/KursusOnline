<div class="container d-flex flex-column align-items-center gap-4">
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
                                <img src="{{ Storage::disk('s3')->url($course->lecturer->photo) }}"
                                     alt="Lecturer's photo"
                                     class="rounded-circle shadow-sm"
                                     style="width: 70px; height: 70px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/EmptyProfile.png') }}"
                                     alt="Default profile picture"
                                     class="rounded-circle shadow-sm"
                                     style="width: 70px; height: 70px; object-fit: cover;">
                            @endif
                            <div>
                                <div class="fw-semibold">{{ $course->lecturer->name }}</div>
                                <div class="text-muted">Lecturer</div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <a href="{{ Auth::check() && Auth::user()->role_id == 1
                                    ? route('courseDetailPage.view', $course->id)
                                    : route('enrollmentPage.view', $course->id) }}"
                           class="btn btn-outline-primary btn-hover">
                            {{ Auth::check() && Auth::user()->role_id == 1 ? 'View Course' : 'Show Details...' }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
