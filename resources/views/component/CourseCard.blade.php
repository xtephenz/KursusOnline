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
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $courses[$i]->name }}</h5>
                    <div class="mt-auto">
                        <a href="{{ route('courseDetailPage.view', $courses[$i]->id) }}" class="btn btn-primary">Show Details...</a>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>