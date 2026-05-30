@extends('layouts.app') {{-- or your frontend layout --}}

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="row g-0">
            <div class="col-md-5">
                @if($product->image)
                    <img src="{{ asset($product->image) }}" class="img-fluid rounded-start" alt="{{ $product->name }}">
                @endif

                @if($product->images && $product->images->count())
                    <div class="d-flex flex-wrap gap-2 mt-3">
                        @foreach($product->images as $img)
                            <img src="{{ asset('uploads/product_images/' . $img->image) }}" class="img-thumbnail" style="width: 75px; height: 75px; object-fit: cover;">
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col-md-7 p-4">
                <h3>{{ $product->name }}</h3>
                <p class="text-muted mb-1">Brand: {{ $product->brand->name ?? '-' }}</p>
                <p class="text-muted">Category: {{ $product->category->name ?? '-' }}</p>

                <h4 class="text-success">${{ number_format($product->selling_price, 2) }}</h4>

                <p class="mt-3">{{ $product->small_description }}</p>

                <div class="mt-4">
                    <h6>Description</h6>
                    <p>{!! nl2br(e($product->description)) !!}</p>
                </div>

                <p class="mt-3">
                    @if($product->quantity > 0)
                        <span class="badge bg-success">In Stock</span>
                    @else
                        <span class="badge bg-danger">Out of Stock</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
