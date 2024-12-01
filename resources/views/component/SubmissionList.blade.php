<div class="container">
    <h4>Submission</h4>
    <table class="table">
        <thead>
            <th>No</th>
            <th>Student</th>
            <th>Photo</th>
            <th>Submission</th>
            <th>Submit At</th>
            <th>Total Attempt</th>
            <th>Score</th>
            <th>Action</th>
        </thead>
        <tbody>
            @if ($submissions->isNotEmpty())
                @for ($i = 0; $i < count($submissions); $i++)
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>
                            {{$submissions[$i]->student->name}}
                        </td>
                        <td>
                            @if ($submissions[$i]->student->photo)
                                <img src="{{ asset($submissions[$i]->student->photo) }}" alt="Student's photo" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;" class="me-3">
                            @else
                                <img src="{{ asset('EmptyProfile.png') }}" alt="Default profile picture" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;" class="me-3">
                            @endif 
                        </td>
                            <td><a href="{{ route('submission.download', ['submission_id' => $submissions[$i]->id]) }}"><img src="{{ asset('DownloadIcon.png') }}" alt="" width="30px"></a></td>
                        <td>{{$submissions[$i]->submit_date->format('j F Y')}}</td>
                        <td>{{$submissions[$i]->attempt_number}}</td>
                        <td>
                            @if ($submissions[$i]->score != null)
                                {{$submissions[$i]->score}}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if ($submissions[$i]->score != null)
                                <a href="{{ route('scoringPage.view', ['submission_id' => $submissions[$i]->id]) }}">Edit Score</a>
                            @else
                                <a href="{{ route('scoringPage.view', ['submission_id' => $submissions[$i]->id]) }}">Score</a>
                            @endif
                        </td>
                    </tr>
                @endfor
            @else
                <tr>
                    <td colspan="8">
                        <h5 class="text-center text-danger">No Submission Yet!</h5>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>