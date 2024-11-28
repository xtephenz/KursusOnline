<div class="container d-flex flex-column align-items-start gap-2">
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
                    <div class="d-flex flex-row justify-content-between">
                        <h5 class="card-title">{{ $assignments[$i]->title }}</h5>
                        @if (Auth::user()->role_id == 2)
                            @if ($assignments[$i]->submissions->where('student_id', Auth::user()->id)->where('attempt_number', '>=', 1)->isNotEmpty())
                                <img src="{{ asset('DoneIcon.png') }}" alt="Done Icon" width="30px">
                            @endif                
                        @endif
                    </div>
                    <div class="d-flex flex-column">
                        <div>
                            Start: {{$assignments[$i]->start_date->format('j F Y')}}
                        </div>
                        <div>
                            Due: {{$assignments[$i]->due_date->format('j F Y')}}
                        </div>
                        <div>
                            Status: {{$assignments[$i]->status}}
                        </div>
                        @if (Auth::user()->role_id == 3)
                            <div>
                                Submissions: <a href="{{ route('assignmentDetailPage.view', ['assignment_id' => $assignments[$i]->id]) }}">{{count($assignments[$i]->submissions)}}</a>
                            </div>
                        @endif
                    </div>
                    <div class="mt-auto">
                        <a href="{{ route('assignmentDetailPage.view', ['assignment_id' => $assignments[$i]->id]) }}" class="btn btn-primary">View Assignment</a>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>