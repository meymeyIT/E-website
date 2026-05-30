@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <!-- Page Header -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">🛒 All Products</h2>
        <p class="text-muted fs-5">Browse our complete collection of products.</p>
    </div>

    <!-- Product Grid -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse ($products as $product)
            <div class="col">
                <div class="card h-100 shadow-sm border-0 product-card rounded-4 overflow-hidden">
                    <!-- Product Image -->
                    <div class="ratio ratio-4x3 bg-light overflow-hidden rounded-top">
                        @php
                            $imagePath = $product->image ? public_path($product->image) : null;
                        @endphp

                        @if($product->image && $imagePath && file_exists($imagePath))
                            <img src="{{ asset($product->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('assets/images/no-image.png') }}" class="w-100 h-100 object-fit-cover" alt="No image available">
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="card-body d-flex flex-column">
                        <h6 class="fw-semibold text-dark mb-2 text-truncate" title="{{ $product->name }}">{{ $product->name }}</h6>
                        <p class="text-primary fw-bold fs-5 mb-3">${{ number_format($product->selling_price, 2) }}</p>
                    </div>

                    <!-- Product Actions -->
                    <div class="card-footer bg-white border-0 px-3 pb-3 d-flex gap-2">
                        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-sm btn-outline-primary w-50 d-flex align-items-center justify-content-center gap-2">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-50 m-0">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="fas fa-shopping-cart"></i> Buy
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="col-12 text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <p class="text-muted fs-5 mb-0">No products available at the moment.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Custom Styles -->
<style>
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 0.75rem;
        cursor: pointer;
    }
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.15);
        z-index: 1;
    }
    .object-fit-cover {
        object-fit: cover;
    }
    /* Text truncate for product name */
    .text-truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    /* Buttons with icons spacing */
    .btn > i {
        transition: transform 0.3s ease;
    }
    .btn:hover > i {
        transform: translateX(5px);
    }
</style>
@endsection
