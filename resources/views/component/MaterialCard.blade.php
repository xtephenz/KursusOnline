<div class="container my-4" style="border: 2px solid black; border-radius: 10px; width: 500px; margin-left: 0">
    <h5 class="mt-2">Materials</h5>
    <hr>
    <div class="d-flex flex-column gap-3">
        @if ($materials->isNotEmpty())
            @foreach ($materials as $material)
                <div class="d-flex flex-row justify-content-between">
                    <h6>{{ $material->title }}</h6>
                    <a href="{{ route('material.download', ['material_id' => $material->id]) }}"><img src="{{ asset('DownloadIcon.png') }}" alt="" width="30px"></a>
                </div>
            @endforeach
        @else
            <h6>TBA</h6>
        @endif
    </div>
</div>