@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <!-- Page Title -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">{{ $category->name }}</h2>
        <p class="text-muted">Browse all products available in this category</p>
    </div>

    <!-- Product Grid -->
    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 shadow-sm rounded-4 product-card">
                    <!-- Product Image -->
                    <div class="ratio ratio-4x3 rounded-top overflow-hidden bg-light">
                        @if($product->image && file_exists(public_path($product->image)))
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-100 h-100 object-fit-cover">
                        @else
                            <img src="{{ asset('assets/images/no-image.png') }}" alt="No image" class="w-100 h-100 object-fit-cover">
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="card-body d-flex flex-column">
                        <h6 class="fw-semibold text-dark mb-2">{{ $product->name }}</h6>
                        <div class="mt-auto">
                            <p class="text-primary fw-bold fs-5 mb-3">${{ number_format($product->selling_price, 2) }}</p>
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline-primary w-100">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <!-- No Products Found -->
            <div class="col-12 text-center py-5">
                <i class="fas fa-box-open fa-2x text-muted mb-3"></i>
                <p class="text-muted mb-0">No products found in this category.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $products->links() }}
        </div>
    @endif
</div>

<!-- Custom Styles -->
<style>
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
    }
    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endsection
