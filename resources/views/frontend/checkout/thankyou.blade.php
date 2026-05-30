@extends('layouts.frontend')

@section('content')
<div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="alert alert-success text-center rounded-4 shadow p-5 w-100" style="max-width: 480px;">
        <h2 class="mb-3 text-success">Thank You!</h2>
        <p class="mb-4 fs-5">
            Your order has been placed successfully. We appreciate your business.
        </p>
        <a href="{{ route('home') }}" class="btn btn-primary btn-lg px-4">
            Back to Home
        </a>
    </div>
</div>
@endsection
