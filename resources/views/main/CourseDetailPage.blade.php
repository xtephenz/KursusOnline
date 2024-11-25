@extends('layout.master')
@section('content')
    {{-- TAMPILANNYA TOLONG DIGANTI YGY INI ISENG AJA HEHEHEHEHEHE --}}
    <div class="container">
    </div>
    <div class="container my-4" style="border: 2px solid red; width: 510px; border-radius: 10px">
        {{-- UBAH ROUTE KE COURSES PAGE --}}
        <div class="position-relative">
            <a href="{{ route('homePage') }}" class="position-absolute" style="left: 0;">
                <img src="{{ asset('BackArrow.png') }}" alt="Back Arrow" style="width: 25px;">
            </a>
            <h4 class="text-center">{{$course->name}}</h4>
        </div>
        <table class="table d-flex flex-row justify-content-center" style="border-color: transparent">
            <tbody>
                <tr>
                    <td class="d-flex justify-content-center">
                        <div class="fs-5 d-inline-flex">
                            @if ($course->lecturer->photo)
                                <img src="{{ asset($course->lecturer->photo) }}" alt="Lecturer's photo" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;" class="me-3">
                            @else
                                <img src="{{ asset('EmptyProfile.png') }}" alt="Default profile picture" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;" class="me-3">
                            @endif    
                            <div class="d-flex flex-column">
                                <span class="fw-semibold">{{$course->lecturer->name}}</span>
                                <small class="text-muted">Lecturer</small>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="text-center">Topics</h5>
                    </td>
                </tr>
                <tr >
                    <td class="fs-5 d-flex justify-content-center">
                        @if ($course->topics->isNotEmpty())
                            @for ($i = 0; $i < count($course->topics); $i++)
                                {{$i+1}}. {{$course->topics[$i]->title}} <br>
                            @endfor
                        @else
                            TBA
                        @endif
                    </td>
                </tr>
                <tr class="d-flex justify-content-center">
                    <td>
                        <a href="" class="btn btn-primary">Enroll Course</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection