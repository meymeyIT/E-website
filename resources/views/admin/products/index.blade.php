@extends('layouts.admin')

@section('content')
<div class="card mt-4 shadow border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-2 px-3 rounded-top">
        <h4 class="mb-0">
            <i class="fas fa-boxes me-2"></i> Products
        </h4>
        <a href="{{ route('admin.products.create') }}" class="btn btn-outline-light btn-sm">
            <i class="fas fa-plus-circle me-1"></i> Add Product
        </a>
    </div>

    <div class="card-body bg-white p-3 rounded-bottom">
        {{-- Search Form --}}
        <form action="{{ route('admin.products.index') }}" method="GET" class="mb-3">
            <div class="input-group input-group-sm shadow-sm rounded" style="max-width: 360px;">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    class="form-control border-primary rounded-start"
                    placeholder="Search by product name..."
                    autocomplete="off"
                    aria-label="Search products"
                >
                <button class="btn btn-primary rounded-end d-flex align-items-center justify-content-center" type="submit" title="Search">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>

        {{-- Success Message --}}
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show small" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Products Table --}}
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-nowrap table-sm mb-0">
                <thead class="table-primary text-center small">
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th>Name &amp; Price</th>
                        <th style="width: 90px;">Image</th>
                        <th style="width: 90px;">Active</th>
                        <th style="width: 70px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="text-center">{{ $product->id }}</td>
                            <td>
                                <div class="fw-semibold">{{ $product->name }}</div>
                                <div class="text-success fw-bold small">
                                    ${{ number_format($product->selling_price, 2) }}
                                </div>
                                <div class="small text-muted">
                                    <span class="me-2">
                                        <strong>Category:</strong> 
                                        <span class="badge bg-info text-dark">
                                            {{ $product->category?->name ?? 'N/A' }}
                                        </span>
                                    </span>
                                    <span>
                                        <strong>Brand:</strong> 
                                        <span class="badge bg-secondary">
                                            {{ $product->brand?->name ?? 'N/A' }}
                                        </span>
                                    </span>
                                </div>
                            </td>

                            <td class="text-center">
                                @if ($product->image && file_exists(public_path($product->image)))
                                    <img 
                                        src="{{ asset($product->image) }}" 
                                        alt="{{ $product->name }}" 
                                        style="width: 45px; height: 45px; object-fit: cover;"
                                        class="rounded"
                                        loading="lazy"
                                    >
                                @else
                                    <span class="text-muted small">No Image</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }} small px-2 py-1">
                                    {{ $product->is_active ? 'Yes' : 'No' }}
                                </span>
                            </td>

                            <td class="text-center">
                                <div class="dropdown">
                                    <button 
                                        class="btn btn-sm btn-light border dropdown-toggle p-1"
                                        type="button" 
                                        id="actionsDropdown{{ $product->id }}" 
                                        data-bs-toggle="dropdown" 
                                        aria-expanded="false"
                                        style="width: 28px; height: 28px;"
                                        title="Actions"
                                    >
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionsDropdown{{ $product->id }}">
                                        <li>
                                            <a href="{{ route('admin.products.show', $product->slug) }}" class="dropdown-item">
                                                <i class="fas fa-eye me-1"></i> Show
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.products.edit', $product->slug) }}" class="dropdown-item">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.products.images.index', $product->slug) }}" class="dropdown-item">
                                                <i class="fas fa-upload me-1"></i> Upload Images
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form 
                                                action="{{ route('admin.products.destroy', $product->slug) }}" 
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this product?')"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fas fa-trash-alt me-1"></i> Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted small">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

           
        </div>
    </div>
</div>

{{-- Custom CSS for search form --}}
<style>
    .input-group-sm {
        max-width: 360px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-radius: 0.35rem;
        overflow: hidden;
    }
    .input-group-sm .form-control {
        border: none;
        box-shadow: none;
        outline: none;
        padding-left: 1rem;
    }
    .input-group-sm .form-control:focus {
        outline: none;
        box-shadow: none;
        border-color: #0d6efd;
    }
    .input-group-sm .btn-primary {
        background-color: #0d6efd;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 0.75rem;
    }
    .input-group-sm .btn-primary:hover, 
    .input-group-sm .btn-primary:focus {
        background-color: #0b5ed7;
        box-shadow: 0 0 8px rgba(11, 94, 215, 0.5);
    }
</style>
@endsection
