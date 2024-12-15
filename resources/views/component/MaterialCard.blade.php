<div class="container my-4 p-4 shadow-lg" style="border: 2px solid #ddd; border-radius: 10px; width: 500px; margin-left: 0;">
    <h5 class="mt-2 text-primary" style="font-weight: bold;">Materials</h5>
    <hr>
    <div class="d-flex flex-column gap-4">
        @if ($materials->isNotEmpty())
            @foreach ($materials as $material)
                <div class="d-flex flex-row justify-content-between align-items-center border-bottom pb-3">
                    <h6 class="mb-0">{{ $material->title }}</h6>
                    <div class="d-flex align-items-center gap-3">
                        <!-- Download Button -->
                        <a href="{{ route('material.download', ['material_id' => $material->id]) }}" class="text-decoration-none">
                            <img src="{{ asset('images/DownloadIcon.png') }}" alt="Download" width="30px" class="me-2">
                        </a>

                        <!-- Delete Button (Visible if user role is not 2) -->
                        @if (Auth::check() && Auth::user()->role_id != 2)
                            <button type="button" class="btn btn-link p-0" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#deleteMaterialModal{{ $material->id }}">
                                <img src="{{ asset('images/DeleteIcon.png') }}" alt="Delete" width="30px">
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Modal for Delete Confirmation -->
                @if (Auth::check() && Auth::user()->role_id != 2)
                    <div class="modal fade" id="deleteMaterialModal{{ $material->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $material->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $material->id }}">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this material?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('material.delete', ['material_id' => $material->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <h6 class="text-center text-muted">TBA</h6>
        @endif
    </div>
</div>
