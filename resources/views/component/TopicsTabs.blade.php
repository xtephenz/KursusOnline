<div class="d-flex flex-row justify-content-start flex-wrap gap-2">
    @for ($i = 0; $i < count($topics); $i++)
        <ul class="nav nav-tabs my-2">
            <li class="nav-item">
                <a class="nav-link px-4 py-2 text-center {{ request('topic_id') == $topics[$i]->id ? 'active' : '' }}"
                   href="{{ route('courseDetailPage.view', ['course_id' => $course->id, 'topic_id' => $topics[$i]->id]) }}"
                   style="border-radius: 5px;">
                   Topic {{$i+1}}
                </a>
            </li>
        </ul>
    @endfor
</div>
