<div class="container">
    <h4>Submission History</h4>
    <table class="table">
        <thead>
            <th>Submission Attempt</th>
            <th>File</th>
            <th>Submit At</th>
            <th>Status</th>
            <th>Score</th>
        </thead>
        <tbody>
            <tr>
                <td>{{$submission->attempt_number}}</td>
                <td><a href="{{ route('submission.download', ['submission_id' => $submission->id]) }}"><img src="{{ asset('DownloadIcon.png') }}" alt="" width="30px"></a></td>
                <td>{{$submission->submit_date->format('j F Y')}}</td>
                <td>{{$submission->status}}</td>
                <td>
                    @if ($submission->score == null)
                        N/A
                    @else
                        {{$submission->score}}
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</div>