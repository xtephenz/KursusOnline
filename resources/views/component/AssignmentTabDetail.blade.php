<div class="container my-2">
    @if (session('success'))
        <div class="alert alert-success mt-3 mx-2">{{session('success')}}</div>
    @endif
    @if (Auth::check() && Auth::user()->role_id == 3)
        <div class="d-flex justify-content-start my-3">
            <a href="{{ route('addAssignmentPage.view', ['course_id' => $course->id]) }}" class="btn btn-primary">Add New Assignment</a>
        </div>
    @endif
    @include('component.AssignmentCard', ['assignments' => $assignments])
</div>