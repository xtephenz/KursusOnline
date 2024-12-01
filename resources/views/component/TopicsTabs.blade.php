<div class="d-flex flex-row justify-content-start">
    @for ($i = 0; $i < count($topics); $i++)
        <ul class="nav nav-tabs my-2 me-1">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('courseDetailPage.view', ['course_id' => $course->id, 'topic_id' => $topics[$i]->id]) }}">Topic {{$i+1}}</a>
            </li>
        </ul>
    @endfor
</div>