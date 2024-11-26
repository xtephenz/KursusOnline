<div class="container d-flex flex-column align-items-center gap-2">
    @php
        $coursesPerRow = 3;
    @endphp
    <div class="row gap-3 my-1">
        @for ($i = 0; $i < count($assignments); $i++)         
            @if ($i % $coursesPerRow == 0 && $i != 0)
                </div><div class="row gap-3 my-1">
            @endif
            <div class="card" style="width: 20rem;">
                <div class="card-body d-flex flex-column gap-1">
                    <h5 class="card-title">{{ $assignments[$i]->title }}</h5>
                    Due: {{$assignments[$i]->due_date}}
                    Status: {{$assignments[$i]->status}}
                    <div class="mt-auto">
                        <a href="{{ route('enrollmentPage.view', $courses[$i]->id) }}" class="btn btn-primary">Show Details...</a>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>