@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    @if ($about)
        <div class="text-center mb-5">
            <h1 class="fw-bold text-primary">{{ $about->title }}</h1>
            <p class="text-muted fs-5">Your trusted source for quality and care.</p>
        </div>

        <div class="row justify-content-center align-items-center g-4">
            <div class="col-md-6">
                @if($about->image && file_exists(public_path($about->image)))
                    <img src="{{ asset($about->image) }}" alt="About Image" class="img-fluid rounded-4 shadow-sm w-100" style="max-height: 400px; object-fit: cover;">
                @else
                    <img src="{{ asset('assets/images/no-image.png') }}" alt="No Image" class="img-fluid rounded-4 shadow-sm w-100" style="max-height: 400px; object-fit: cover;">
                @endif
            </div>
            <div class="col-md-6">
                <div class="bg-light p-4 rounded-4 shadow-sm">
                    <h4 class="fw-semibold mb-3">Our Story</h4>
                    <p class="text-secondary">{{ $about->description }}</p>

                    <hr class="my-4">

                    <h5 class="fw-semibold">Why Choose Us?</h5>
                    <ul class="list-unstyled text-secondary">
                        <li>✅ We care about quality and service</li>
                        <li>✅ Our mission is customer satisfaction</li>
                        <li>✅ We’re committed to fair pricing</li>
                        <li>✅ We stand out by being honest and transparent</li>
                        <li>✅ Every customer matters to us</li>
                    </ul>
                </div>
            </div>
        </div>
    @else
        <div class="text-center text-muted">
            <h3>No about us content available yet.</h3>
            <p>Please add content in the admin panel or database.</p>
        </div>
    @endif
</div>
@endsection
