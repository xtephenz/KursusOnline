@extends('layout.master')
@section('content')
    <div class="container-fluid">
        @if (Auth::check())
            <!-- If the user is logged in, show a personalized message -->
            <h3>Welcome, {{ Auth::user()->name }}</h3>
        @else
            <!-- If the user is not logged in, show a generic message -->
            <h3>Welcome to Kursus Online!</h3>
        @endif
        
    </div>
@endsection