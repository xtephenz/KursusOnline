<h5>Students</h5>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <thead class="thead-light">
            <tr>
                <th>Name</th>
                <th>Photo</th>
                <th>Email</th>
                @if (Auth::check() && Auth::user()->role_id == 3)
                    <th>Submission(s)</th>
                    <th>Final Score</th>
                    <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if ($activeStudents->isNotEmpty())
                @foreach ($activeStudents as $student)
                    <tr>
                        <td>{{$student->name}}</td>
                        <td>
                            @if ($student->photo)
                                <img src="{{ Storage::disk('s3')->url($student->photo) }}" alt="Student's photo" class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/EmptyProfile.png') }}" alt="Default profile picture" class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
                            @endif
                        </td>
                        <td><a href="mailto:{{$student->email}}">{{$student->email}}</a></td>
                        @php
                            $enrollment = $student->enrollments->where('course_id', $course->id)->first();
                        @endphp
                        @if (Auth::check() && Auth::user()->role_id == 3)
                            <td>{{ count($student->submissions) }}</td>
                            <td>
                                @if ($enrollment->final_score !== null)
                                    {{$enrollment->final_score}}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if (count($student->submissions) < count($course->assignments))
                                    {{ count($student->submissions) }} assignments done of {{ count($course->assignments) }}
                                @elseif (count($course->assignments) == 0)
                                    No assignments yet!
                                @elseif ($student->submissions->contains('score', null))
                                    Assignment(s) not yet assessed!
                                @elseif ($enrollment->final_score !== null)
                                    Final score has been submitted!
                                @else
                                    <a href="{{ route('finalScoreSubmissionPage.view', ['course_id' => $course->id, 'student_id' => $student->id]) }}">Submit Final Score</a>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center text-danger">
                        <h5>No Students Yet!</h5>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

@if (Auth::check() && Auth::user()->role_id != 2)
    <br>
    <h5>Previous Students</h5>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Email</th>
                    @if (Auth::check() && Auth::user()->role_id == 3)
                        <th>Submission(s)</th>
                        <th>Final Score</th>
                        <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @if ($finishedStudents->isNotEmpty())
                    @foreach ($finishedStudents as $student)
                        <tr>
                            <td>{{$student->name}}</td>
                            <td>
                                @if ($student->photo)
                                    <img src="{{ Storage::disk('s3')->url($student->photo) }}" alt="Student's photo" class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/EmptyProfile.png') }}" alt="Default profile picture" class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
                                @endif
                            </td>
                            <td><a href="mailto:{{$student->email}}">{{$student->email}}</a></td>
                            @php
                                $enrollment = $student->enrollments->where('course_id', $course->id)->first();
                            @endphp
                            @if (Auth::check() && Auth::user()->role_id == 3)
                                <td>{{ count($student->submissions) }}</td>
                                <td>
                                    @if ($enrollment->final_score !== null)
                                        {{$enrollment->final_score}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if (count($student->submissions) < count($course->assignments))
                                        {{ count($student->submissions) }} assignments done of {{ count($course->assignments) }}
                                    @elseif ($student->submissions->contains('score', null))
                                        Assignment(s) not yet assessed!
                                    @elseif ($enrollment->final_score !== null)
                                        Final score has been submitted!
                                    @else
                                        <a href="{{ route('finalScoreSubmissionPage.view', ['course_id' => $course->id, 'student_id' => $student->id]) }}">Submit Final Score</a>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center text-danger">
                            <h5>No Previous Students Yet!</h5>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endif
