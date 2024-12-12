<div class="container d-flex flex-column align-items-center gap-2">
    @php
        $coursesPerRow = 3;
    @endphp
    <div class="row gap-3">
        @for ($i = 0; $i < count($courses); $i++)
            @if ($i % $coursesPerRow == 0 && $i != 0)
                </div><div class="row gap-3">
            @endif
            <div class="card shadow-sm" style="width: 25rem; border-radius: 15px;">
                <div class="card-body d-flex flex-column gap-1">
                    <h5 class="card-title">{{ $courses[$i]->name }}</h5>
                    <div class="d-flex align-items-center gap-3">
                        @if ($course->lecturer->photo)
                            <img src="{{ Storage::disk('s3')->url($course->lecturer->photo) }}" alt="Lecturer's photo"
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
                    <a href="{{ route('finalScorePage.view', ['course_id' => $courses[$i]->id]) }}" class="btn btn-outline-primary btn-hover">View Final Score</a>
                </div>
            </div>
        @endfor
    </div>
</div>
