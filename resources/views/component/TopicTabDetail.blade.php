<div class="container my-2">
    @if (session('success'))
        <div class="alert alert-success mt-3 mx-2">{{session('success')}}</div>
    @endif
    <div class="d-flex align-items-center gap-2">
        <h4>{{$topic->title}}</h4>
        @if (Auth::check() && Auth::user()->role_id == 1)
        <div class="d-flex align-items-center">
            <a href="{{ route('editTopicPage.view', ['topic_id' => $topic->id]) }}"><img src="{{ asset('EditIcon.png') }}" alt="" width="30px"></a>
            <button type="submit" style="border: none; background: none; padding: 0;" data-bs-toggle="modal" data-bs-target="#deleteTopicModal">
                <img src="{{ asset('DeleteIcon.png') }}" alt="Delete Icon" width="30px">
            </button>
            <div class="modal fade" id="deleteTopicModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this topic?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ route('topic.delete', ['topic_id' => $topic->id]) }}" method="POST" id="confirmDeleteForm">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="delete_action" id="deleteAction">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        @endif
    </div>
    @if (Auth::check() && Auth::user()->role_id == 3)
        <div class="d-flex justify-content-start my-3">
            <a href="{{ route('addMaterialPage.view', ['topic_id'=>$topic->id]) }}" class="btn btn-primary">Add New Material</a>
        </div>
    @endif
    @include('component.MaterialCard', ['materials' => $topic->materials])
</div>