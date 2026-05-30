@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Explore Our Categories</h2>
        <p class="text-muted">Browse products by category and discover what you need.</p>
    </div>

    @if ($categories->isNotEmpty())
        <div class="row g-4">
            @foreach ($categories as $category)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm border-0 category-card">
                        <div class="ratio ratio-4x3 rounded-top overflow-hidden">
                            @if($category->image && file_exists(public_path($category->image)))
                                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="img-fluid object-fit-cover">
                            @else
                                <img src="{{ asset('assets/images/no-image.png') }}" alt="No image" class="img-fluid object-fit-cover">
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-center fw-semibold mb-3">{{ $category->name }}</h5>
                            <a href="{{ route('categories.show', $category->slug) }}" class="btn btn-outline-primary mt-auto w-100">
                                View Products
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="col-12 text-center py-5">
            <i class="fas fa-folder-open fa-2x text-muted mb-3"></i>
            <p class="text-muted mb-0">No categories found.</p>
        </div>
    @endif
</div>

<style>
    .category-card:hover {
        transform: translateY(-4px);
        transition: 0.3s ease-in-out;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }
    .object-fit-cover {
        object-fit: cover;
        width: 100%;
        height: 100%;
    }
</style>
@endsection
