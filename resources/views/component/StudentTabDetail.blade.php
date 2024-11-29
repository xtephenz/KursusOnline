<table class="table">
    <thead>
        <th>Name</th>
        <th>Photo</th>
        <th>Email</th>
    </thead>
    <tbody>
        @if ($students->isNotEmpty())
            @foreach ($students as $student)
                <tr>
                    <td>{{$student->name}}</td>
                    <td>
                        @if ($course->lecturer->photo)
                            <img src="{{ asset($course->lecturer->photo) }}" alt="Lecturer's photo" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;" class="me-3">
                        @else
                            <img src="{{ asset('EmptyProfile.png') }}" alt="Default profile picture" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;" class="me-3">
                        @endif 
                    </td>
                    <td><a href="mailto:{{$student->email}}">{{$student->email}}</a></td>
                </tr>
            @endforeach
        @else
            <td colspan="3">
                <h5 class="text-center text-danger">No Student Yet!</h5>
            </td>
        @endif
    </tbody>
</table>