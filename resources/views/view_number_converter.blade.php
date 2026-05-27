@extends('layouts.app')

@section('title', 'Number Converter')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Word & Number Converter</h2>

    <form action="{{ route('convert') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Enter a number or words:</label>

            <input type="text"
                   name="value"
                   class="form-control"
                   placeholder="e.g. 390 or three hundred and ninety"
                   value="{{ $input ?? '' }}">
        </div>

        <button type="submit" class="btn btn-primary">
            Convert
        </button>
    </form>

    @isset($input)
        <div class="row mt-4">

            @if(is_numeric($input))
                <div class="col-md-6">
                    <div class="card p-3">
                        <h5>In Words</h5>
                        <p class="mb-0">{{ $words }}</p>
                    </div>
                </div>
            @else
                <div class="col-md-6">
                    <div class="card p-3">
                        <h5>In Numbers</h5>
                        <p class="mb-0">{{ $number }}</p>
                    </div>
                </div>
            @endif

            <div class="col-md-6">
                <div class="card p-3">
                    <h5>In USD</h5>
                    <p class="mb-0">${{ $usd }}</p>
                </div>
            </div>

        </div>
    @endisset
</div>
@endsection