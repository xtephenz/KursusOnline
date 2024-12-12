<div class="container my-4">
    {{-- Success Alert --}}
    @if (session('success'))
        <div class="alert alert-success mt-3 mx-2 rounded-3 shadow-sm">{{ session('success') }}</div>
    @endif

    {{-- Topic Title and Action Buttons --}}
    <div class="d-flex align-items-center justify-content-between gap-2 mb-4">
        <h4>{{$topic->title}}</h4>

        @if (Auth::check() && Auth::user()->role_id == 1)
        <div class="d-flex align-items-center gap-3">
            {{-- Edit Button --}}
            <a href="{{ route('editTopicPage.view', ['topic_id' => $topic->id]) }}"
                class="btn btn-outline-secondary d-flex align-items-center"
                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Topic">
                <img src="{{ asset('images/EditIcon.png') }}" alt="Edit Icon" width="25px" class="me-2">
                Edit
            </a>

            {{-- Delete Button --}}
            <button type="submit" class="btn btn-outline-danger d-flex align-items-center"
                data-bs-toggle="modal" data-bs-target="#deleteTopicModal"
                data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Topic">
                <img src="{{ asset('images/DeleteIcon.png') }}" alt="Delete Icon" width="25px" class="me-2">
                Delete
            </button>

            {{-- Delete Modal --}}
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

    {{-- Add Material Button for Role 3 --}}
    @if (Auth::check() && Auth::user()->role_id == 3)
        <div class="d-flex justify-content-start my-3">
            <a href="{{ route('addMaterialPage.view', ['topic_id' => $topic->id]) }}" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-circle"></i> Add New Material
            </a>
        </div>
    @endif

    {{-- Display Materials --}}
    @include('component.MaterialCard', ['materials' => $topic->materials])
</div>
