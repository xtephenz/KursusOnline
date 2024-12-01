<div class="container my-2">
    @if (session('success'))
        <div class="alert alert-success mt-3 mx-2">{{session('success')}}</div>
    @endif
    @include('component.AssignmentCard', ['assignments' => $assignments])
</div>