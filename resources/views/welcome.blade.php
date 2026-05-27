@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="container d-flex flex-column align-items-center justify-content-center vh-100">

    <h1 class="mb-3 fw-bold">
        Word & Number Converter
    </h1>

    <p class="text-muted mb-4">
        Convert words to numbers and vice versa!
    </p>

    <a href="{{ route('view_number_converter') }}"
       class="btn btn-primary btn-lg">
        Get Started
    </a>

</div>
@endsection