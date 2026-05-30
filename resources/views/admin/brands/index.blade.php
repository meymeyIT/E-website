@extends('layouts.admin')

@section('content')
<div class="card mt-4 shadow border-0">
    <!-- Card Header -->
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">
            <i class="fas fa-list me-2"></i> Brands
        </h4>
        <a href="{{ url('/admin/brands/create') }}" class="btn btn-outline-light btn-sm" aria-label="Add new brand">
            <i class="fas fa-plus-circle me-1"></i> Add Brand
        </a>
    </div>

    <!-- Card Body -->
    <div class="card-body bg-white">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Search Form -->
        <form method="GET" action="{{ url('/admin/brands') }}" class="mb-4">
            <div class="input-group shadow-sm rounded">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    class="form-control rounded-start border-primary"
                    placeholder="Search brands by name..." 
                    aria-label="Search brands"
                    autocomplete="off"
                >
                <button class="btn btn-primary rounded-end" type="submit" aria-label="Search brands">
                    <i class="fas fa-search me-1"></i> Search
                </button>
            </div>
        </form>

        <!-- Responsive Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-nowrap">
                <thead class="table-primary text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col" style="width:120px;">Is-active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($brands as $brand)
                        <tr>
                            <td class="text-center">{{ $brand->id }}</td>
                            <td>{{ $brand->name }}</td>
                            <td class="text-center">
                                @if($brand->image)
                                    <img src="{{ asset($brand->image) }}" alt="{{ $brand->name }}" width="50" height="50" class="rounded">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $brand->is_active == 1 ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $brand->is_active == 1 ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex flex-wrap gap-1 justify-content-center">
                                    <a href="{{ url('admin/brands/' . $brand->id) }}"
                                       class="btn btn-sm btn-info"
                                       aria-label="View {{ $brand->name }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ url('admin/brands/' . $brand->id . '/edit') }}"
                                       class="btn btn-sm btn-success"
                                       aria-label="Edit {{ $brand->name }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ url('admin/brands/' . $brand->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this brand?')"
                                          style="display:inline-block;"
                                          aria-label="Delete {{ $brand->name }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No brands found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(method_exists($brands, 'links'))
            <div class="d-flex justify-content-center mt-3">
                {{ $brands->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #0d6efd !important;
        box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
    }
    .btn-primary {
        font-weight: 600;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0b5ed7;
    }
</style>
@endsection
