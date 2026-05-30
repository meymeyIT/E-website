@extends('layouts.admin')

@section('content')
<div class="card mt-4 shadow border-0">
    <!-- Card Header -->
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">
            <i class="fas fa-list me-2"></i> Categories
        </h4>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-light btn-sm" aria-label="Add new category">
            <i class="fas fa-plus-circle me-1"></i> Add Category
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

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-nowrap">
                <thead class="table-primary text-center">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Popular</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td class="text-center">{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <span class="badge {{ $category->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $category->status == 1 ? 'Show' : 'Hide' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $category->popular == 1 ? 'bg-warning text-dark' : 'bg-light text-muted' }}">
                                    {{ $category->popular == 1 ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex flex-wrap gap-1 justify-content-center">
                                    <a href="{{ route('admin.categories.show', $category->id) }}"
                                       class="btn btn-sm btn-info"
                                       aria-label="View details of {{ $category->name }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                       class="btn btn-sm btn-success"
                                       aria-label="Edit {{ $category->name }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this category?')"
                                          style="display:inline-block;"
                                          aria-label="Delete {{ $category->name }}">
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
                            <td colspan="5" class="text-center text-muted">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
