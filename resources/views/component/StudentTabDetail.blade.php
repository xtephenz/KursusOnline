<table class="table">
    <thead>
        <th>Name</th>
        <th>Photo</th>
        <th>Email</th>
        @if (Auth::check() && Auth::user()->role_id == 3)
            <th>Submission(s)</th>
            <th>Final Score</th>
            <th>Action</th>
        @endif
    </thead>
    <tbody>
        @if ($activeStudents->isNotEmpty())
            @foreach ($activeStudents as $student)
                <tr>
                    <td>{{$student->name}}</td>
                    <td>
                        @if ($course->lecturer->photo)
                            <img src="{{ asset($course->lecturer->photo) }}" alt="Lecturer's photo" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;" class="me-3">
                        @else
                            <img src="{{ asset('EmptyProfile.png') }}" alt="Default profile picture" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;" class="me-3">
                        @endif 
                    </td>
                    <td><a href="mailto:{{$student->email}}">{{$student->email}}</a></td>
                    @php
                        $enrollment = $student->enrollments->where('course_id', $course->id)->first();
                    @endphp
                    @if (Auth::check() && Auth::user()->role_id == 3)
                        <td>{{count($student->submissions)}}</td>
                        <td>
                            @if ($enrollment->final_score != null)
                                {{$enrollment->final_score}}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if (count($student->submissions) < count($course->assignments))
                                {{count($student->submissions)}} assignments done of {{count($course->assignments)}}
                            @elseif ($student->submissions->contains('score', null))
                                
                                Assignment(s) not yet assessed!
                            @elseif ($enrollment->final_score != null)
                                Final score has been submitted!
                            @else
                                <a href="{{ route('finalScoreSubmissionPage.view', ['course_id' => $course->id, 'student_id' => $student->id]) }}">Submit Final Score</a>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
        @else
            <td colspan="6">
                <h5 class="text-center text-danger">No Student Yet!</h5>
            </td>
        @endif
    </tbody>
</table>