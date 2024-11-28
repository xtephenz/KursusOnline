<div class="container my-4" style="border: 2px solid black; border-radius: 10px; width: 500px; margin-left: 0">
    <h5 class="mt-2">Materials</h5>
    <hr>
    <div class="d-flex flex-column gap-3">
        @if ($materials->isNotEmpty())
            @foreach ($materials as $material)
                <div class="d-flex flex-row justify-content-between mb-2">
                    <h6>{{ $material->title }}</h6>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('material.download', ['material_id' => $material->id]) }}"><img src="{{ asset('DownloadIcon.png') }}" alt="" width="30px"></a>
                        @if (Auth::check() && Auth::user()->role_id == 3)
                            <form action="{{ route('material.delete', ['material_id' => $material->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border: none; background: none; padding: 0;">
                                    <img src="{{ asset('DeleteIcon.png') }}" alt="Delete Icon" width="30px">
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <h6>TBA</h6>
        @endif
    </div>
</div>