<div class="container d-flex flex-column align-items-start gap-2">
    @php
        $coursesPerRow = 3;
    @endphp
    <div class="row gap-3 my-1">
        @for ($i = 0; $i < count($assignments); $i++)
            @if ($i % $coursesPerRow == 0 && $i != 0)
                </div><div class="row gap-3 my-1">
            @endif
            <div class="card shadow-sm" style="width: 20rem; border-radius: 15px;">
                <div class="card-body d-flex flex-column gap-1">
                    @if ($assignments[$i]->status == "On Going")
                        <h1 class="btn" style="width: 110px; background-color: rgb(61, 155, 93); color:white; font-weight: 500; border-radius: 20px;">{{$assignments[$i]->status}}</h1>
                    @elseif ($assignments[$i]->status == "Expired")
                        <h1 class="btn" style="width: 100px; background-color: rgb(203, 45, 45); color:white; font-weight: 500; border-radius: 20px;">{{$assignments[$i]->status}}</h1>
                    @elseif ($assignments[$i]->status == "Coming Soon")
                        <h1 class="btn" style="width: 140px; background-color: rgb(220, 170, 32); color:white; font-weight: 500; border-radius: 20px;">{{$assignments[$i]->status}}</h1>
                    @endif
                    <div class="d-flex justify-content-start align-items-center gap-2">
                        <h5 class="card-title my-0">{{ $assignments[$i]->title }}</h5>
                        @if (Auth::user()->role_id == 2 && $assignments[$i]->submissions->where('student_id', Auth::user()->id)->where('attempt_number', '>=', 1)->isNotEmpty())
                            <img src="{{ asset('images/DoneIcon.png') }}" alt="Done Icon" style="width: 30px; height: 30px">
                        @endif
                    </div>
                    <div class="d-flex flex-column">
                        <div>Start: {{$assignments[$i]->start_date->format('j F Y')}}</div>
                        <div>Due: {{$assignments[$i]->due_date->format('j F Y')}}</div>
                        @if (Auth::user()->role_id == 3)
                            <div>Submissions: <a href="{{ route('assignmentDetailPage.view', ['assignment_id' => $assignments[$i]->id]) }}">{{count($assignments[$i]->submissions)}}</a></div>
                        @endif
                    </div>
                    <div class="mt-auto">
                        <a href="{{ route('assignmentDetailPage.view', ['assignment_id' => $assignments[$i]->id]) }}" class="btn btn-outline-primary">View Assignment</a>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
