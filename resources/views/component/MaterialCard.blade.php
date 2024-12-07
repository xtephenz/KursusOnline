<div class="container my-4" style="border: 2px solid black; border-radius: 10px; width: 500px; margin-left: 0">
    <h5 class="mt-2">Materials</h5>
    <hr>
    <div class="d-flex flex-column gap-3">
        @if ($materials->isNotEmpty())
            @foreach ($materials as $material)
                <div class="d-flex flex-row justify-content-between mb-2">
                    <h6>{{ $material->title }}</h6>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('material.download', ['material_id' => $material->id]) }}"><img src="{{ asset('images/DownloadIcon.png') }}" alt="" width="30px"></a>
                        @if (Auth::check() && Auth::user()->role_id != 2)
                            <button type="submit" style="border: none; background: none; padding: 0;" data-bs-toggle="modal" data-bs-target="#deleteMaterialModal">
                                <img src="{{ asset('images/DeleteIcon.png') }}" alt="Delete Icon" width="30px">
                            </button>
                            <div class="modal fade" id="deleteMaterialModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this material?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('material.delete', ['material_id' => $material->id]) }}" method="POST" id="confirmDeleteForm">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="delete_action" id="deleteAction">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <h6>TBA</h6>
        @endif
    </div>
</div>