<div class="d-flex flex-row gap-3 my-3">
    <ul class="nav nav-pills my-2">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('courseDetailPage.view') ? 'active' : '' }}" href="{{ route('courseDetailPage.view', ['course_id' => $course->id]) }}">Topic</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('courseDetailPage.assignment') ? 'active' : '' }}" href="{{ route('courseDetailPage.assignment', ['course_id' => $course->id]) }}">Assignment</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('courseDetailPage.student') ? 'active' : '' }}" href="{{ route('courseDetailPage.student', ['course_id' => $course->id]) }}">Student</a>
        </li>
    </ul>
</div>
