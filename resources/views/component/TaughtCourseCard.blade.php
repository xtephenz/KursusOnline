<div class="container d-flex flex-column align-items-center gap-2">
    @php
        $coursesPerRow = 3;
    @endphp
    <div class="row gap-3">
        @for ($i = 0; $i < count($courses); $i++)         
            @if ($i % $coursesPerRow == 0 && $i != 0)
                </div><div class="row gap-3">
            @endif
            <div class="card" style="width: 20rem;">
                <div class="card-body d-flex flex-column gap-1">
                    <h5 class="card-title">{{ $courses[$i]->name }}</h5>
                    <div class="fs-5 d-inline-flex">
                        @if ($courses[$i]->lecturer->photo)
                            <img src="{{ asset($courses[$i]->lecturer->photo) }}" alt="Lecturer's photo" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;" class="me-3">
                        @else
                            <img src="{{ asset('EmptyProfile.png') }}" alt="Default profile picture" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;" class="me-3">
                        @endif    
                        <div class="d-flex flex-column">
                            <span class="fw-semibold">{{$courses[$i]->lecturer->name}}</span>
                            <small class="text-muted">Lecturer</small>
                        </div>
                    </div>
                    <div>
                        Student(s): <a href="">{{$courses[$i]->enrollments->where('status', 'Active')->count()}}</a>
                    </div>
                    <div class="mt-auto">
                        <a href="#" class="btn btn-primary">View Course</a>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>