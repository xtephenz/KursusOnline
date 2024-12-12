<div class="container my-4">
    <h4 class="mb-3">Submission History</h4>
    <table class="table table-bordered table-hover table-striped">
        <thead class="thead-light">
            <tr>
                <th>Submission Attempt</th>
                <th>File</th>
                <th>Submitted At</th>
                <th>Status</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$submission->attempt_number}}</td>
                <td>
                    <a href="{{ route('submission.download', ['submission_id' => $submission->id]) }}">
                        <img src="{{ asset('images/DownloadIcon.png') }}" alt="Download Icon" width="30px">
                    </a>
                </td>
                <td>{{$submission->submit_date->format('j F Y')}}</td>
                <td>
                    {{$submission->status}}
                </td>
                <td>
                    @if ($submission->score === null)
                        <span class="text-muted">N/A</span>
                    @else
                        {{$submission->score}}
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</div>
