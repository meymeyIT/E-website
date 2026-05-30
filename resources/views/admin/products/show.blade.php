@extends('layouts.admin')

@section('content')
<div class="card mt-4 shadow-sm border-0" style="max-width: 900px; margin: auto;">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-2 px-3 rounded-top">
        <h5 class="mb-0">Product Details</h5>
        <a href="{{ route('admin.products.index') }}" class="btn btn-light btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Back to Products
        </a>
    </div>

    <div class="card-body p-3">
        <div class="row g-3">
            {{-- Left: Basic Info --}}
            <div class="col-lg-5">
                <h6 class="text-secondary mb-2 fw-semibold">Basic Information</h6>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item d-flex justify-content-between px-2 py-1">
                        <strong>ID:</strong><span>{{ $product->id }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-2 py-1">
                        <strong>Name:</strong><span>{{ $product->name }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-2 py-1">
                        <strong>Category:</strong><span>{{ $product->category->name ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-2 py-1">
                        <strong>Brand:</strong><span>{{ $product->brand->name ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-2 py-1">
                        <strong>Price:</strong>
                        <span class="text-success fw-semibold">${{ number_format($product->selling_price, 2) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-2 py-1">
                        <strong>Stock:</strong><span>{{ $product->quantity }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-2 py-1">
                        <strong>Status:</strong>
                        <span>
                            @if($product->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-2 py-1">
                        <strong>Trending:</strong>
                        <span>
                            @if($product->is_trending)
                                <span class="badge bg-warning text-dark">Yes</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </span>
                    </li>
                </ul>

                {{-- Product Images --}}
                @if($product->images && $product->images->count())
                <div class="mt-3">
                    <h6 class="text-secondary mb-2 fw-semibold">Product Images</h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($product->images as $image)
                            <img src="{{ asset('uploads/product_images/' . $image->image) }}" alt="Product Image" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: contain;">
                        @endforeach
                    </div>
                </div>
                @elseif($product->image)
                <div class="mt-3 text-center">
                    <img src="{{ asset($product->image) }}" alt="Product Image" class="img-fluid rounded shadow-sm" style="max-height: 180px; object-fit: contain;">
                </div>
                @endif
            </div>

            {{-- Right: Descriptions & SEO --}}
            <div class="col-lg-7">
                <h6 class="text-secondary mb-2 fw-semibold">Description</h6>
                <p class="small text-break mb-2">{{ $product->small_description }}</p>
                <hr class="my-2">
                <p class="small text-break">{!! nl2br(e($product->description)) !!}</p>

                <h6 class="text-secondary mt-4 mb-2 fw-semibold">SEO Metadata</h6>
                <dl class="row small">
                    <dt class="col-sm-4">Meta Title</dt>
                    <dd class="col-sm-8">{{ $product->meta_title ?: '-' }}</dd>

                    <dt class="col-sm-4">Meta Description</dt>
                    <dd class="col-sm-8">{{ $product->meta_description ?: '-' }}</dd>

                    <dt class="col-sm-4">Meta Keywords</dt>
                    <dd class="col-sm-8">{{ $product->meta_keyword ?: '-' }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
