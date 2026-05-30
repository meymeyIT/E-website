@extends('layouts.frontend')

@section('content')
<div class="container py-3" style="max-width: 700px;">
    <div class="card border-0 shadow-sm rounded-4" style="background-color: #f9f9f9;">
        <div class="row g-0">
            {{-- Product Image --}}
            <div class="col-md-5 text-center p-3 bg-white rounded-start">
                <div id="zoom-container" class="border rounded-3 overflow-hidden" style="background-color: #fff;">
                    <img 
                        id="zoom-image"
                        src="{{ $product->image ? asset($product->image) : asset('assets/images/no-image.png') }}" 
                        alt="{{ $product->name }}" 
                        class="img-fluid" 
                        style="object-fit: contain; width: 100%; max-height: 180px;"
                        loading="lazy"
                    >
                </div>
            </div>

            {{-- Product Info --}}
            <div class="col-md-7 p-3 bg-light rounded-end">
                <h5 class="fw-bold text-dark">{{ $product->name }}</h5>
                <p class="text-muted small mb-1">Brand: <span class="fw-semibold">{{ $product->brand->name ?? 'N/A' }}</span></p>
                <p class="text-muted small mb-2">Category: <span class="fw-semibold">{{ $product->category->name ?? 'N/A' }}</span></p>

                <h5 class="text-success fw-semibold mb-3">${{ number_format($product->selling_price, 2) }}</h5>

                <p class="small text-body mb-2">{{ $product->small_description }}</p>
                <p class="small text-secondary" style="font-size: 13px;">{!! nl2br(e($product->description)) !!}</p>

                <div class="mt-2">
                    @if($product->quantity > 0)
                        <span class="badge bg-success">In Stock</span>
                    @else
                        <span class="badge bg-danger">Out of Stock</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Enable Panzoom --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const image = document.getElementById('zoom-image');
        const panzoom = Panzoom(image, {
            maxScale: 4,
            contain: 'outside',
            startScale: 1,
        });
        image.parentElement.addEventListener('wheel', panzoom.zoomWithWheel);
    });
</script>
@endsection
