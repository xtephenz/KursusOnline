{{-- 
<div class="container d-flex flex-column align-items-center gap-2">
    @php
        $coursesPerRow = 3;
    @endphp
    <div class="row gap-3">
        @for ($i = 0; $i < count($courses); $i++)         
            @if ($i % $coursesPerRow == 0 && $i != 0)
                </div><div class="row gap-3">
            @endif
            <div class="card" style="width: 25rem;">
                <div class="card-body d-flex flex-column gap-1">
                    <h5 class="card-title">{{ $courses[$i]->name }}</h5>
                    <div class="fs-5 d-inline-flex">
                        @if ($courses[$i]->lecturer->photo)
                            <img src="{{ asset($courses[$i]->lecturer->photo) }}" alt="Lecturer's photo" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;" class="me-3">
                        @else
                            <img src="{{ asset('images/EmptyProfile.png') }}" alt="Default profile picture" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;" class="me-3">
                        @endif    
                        <div class="d-flex flex-column">
                            <span style="font-size: 18.5px">{{$courses[$i]->lecturer->name}}</span>
                            <small class="text-muted">Lecturer</small>
                        </div>
                    </div>
                    @if (Auth::check() && Auth::user()->role_id == 1)
                        <div class="mt-1">
                            <a href="{{ route('courseDetailPage.view', $courses[$i]->id) }}" class="btn btn-primary">View Course</a>
                        </div>
                    @else
                        <div class="mt-1">
                            <a href="{{ route('enrollmentPage.view', $courses[$i]->id) }}" class="btn btn-primary">Show Details...</a>
                        </div>
                    @endif
                </div>
            </div>
        @endfor
    </div>
</div> --}}

<div class="container d-flex flex-column align-items-center gap-4">
    @php
      $coursesPerRow = 3;
    @endphp
    <div class="row row-cols-1 row-cols-md-3 g-4">
      @for ($i = 0; $i < count($courses); $i++)
        <div class="col">
          <div class="card h-10 shadow-sm course-card">
            <div class="card-body d-flex flex-column gap-3">
              <h5 class="card-title">{{ $courses[$i]->name }}</h5>
              <div class="d-flex align-items-center gap-3">
                @if ($courses[$i]->lecturer->photo)
                  <img src="{{ asset($courses[$i]->lecturer->photo) }}" alt="Lecturer's photo" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;" class="me-3">
                @else
                  <img src="{{ asset('images/EmptyProfile.png') }}" alt="Default profile picture" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;" class="me-3">
                @endif
                <div>
                  <div class="fw-medium">{{ $courses[$i]->lecturer->name }}</div>
                  <div class="text-muted">Lecturer</div>
                </div>
              </div>
              @if (Auth::check() && Auth::user()->role_id == 1)
                <a href="{{ route('courseDetailPage.view', $courses[$i]->id) }}" class="btn btn-primary">View Course</a>
              @else
                <a href="{{ route('enrollmentPage.view', $courses[$i]->id) }}" class="btn btn-primary">Show Details...</a>
              @endif
            </div>
          </div>
        </div>
      @endfor
    </div>
  </div>