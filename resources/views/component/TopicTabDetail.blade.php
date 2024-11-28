<div class="container my-2">
    @if (session('success'))
        <div class="alert alert-success mt-3 mx-2">{{session('success')}}</div>
    @endif
    <h4>{{$topic->title}}</h4>
    @if (Auth::check() && Auth::user()->role_id == 3)
        <div class="d-flex justify-content-start my-3">
            <a href="{{ route('addMaterialPage.view', ['topic_id'=>$topic->id]) }}" class="btn btn-primary">Add New Material</a>
        </div>
    @endif
    @include('component.MaterialCard', ['materials' => $topic->materials])
</div>