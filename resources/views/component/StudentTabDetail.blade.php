<table class="table">
    <thead>
        <th>Name</th>
        <th>Photo</th>
        <th>Email</th>
    </thead>
    <tbody>
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
                <td>{{$student->email}}</td>
            </tr>
        @endforeach
    </tbody>
</table>