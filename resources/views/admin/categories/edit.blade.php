@extends('layouts.admin')

@section('content')
<style>
    .card-header {
        background-color: #4a90e2;
        color: white;
        font-weight: 600;
        border-radius: 0.5rem 0.5rem 0 0;
        font-size: 1rem;
        padding: 0.5rem 1rem;
    }
    label {
        font-weight: 600;
        font-size: 0.85rem;
    }
    input.form-control, select.form-select, textarea.form-control {
        border: 1px solid #ccc;
        border-radius: 0.4rem;
        font-size: 0.9rem;
        padding: 0.35rem 0.5rem;
        height: 34px;
    }
    textarea.form-control {
        min-height: 70px;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        height: auto;
    }
    input:focus, select:focus, textarea:focus {
        border-color: #4a90e2;
        box-shadow: 0 0 5px rgba(74, 144, 226, 0.4);
        outline: none;
    }
    .btn-primary, .btn-danger {
        font-size: 0.8rem;
        padding: 0.35rem 1.1rem;
        font-weight: 600;
        border-radius: 0.35rem;
    }
    .btn-danger {
        padding-left: 0.9rem;
        padding-right: 0.9rem;
    }
    img.preview {
        max-width: 90px;
        border-radius: 0.5rem;
        margin-top: 0.4rem;
        border: 1px solid #ccc;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        object-fit: contain;
    }
    .form-check-input {
        width: 1.1rem;
        height: 1.1rem;
    }
    .form-check-label {
        font-size: 0.85rem;
        margin-bottom: 0;
        user-select: none;
    }
    .row.g-3 > [class*="col-"] {
        margin-bottom: 0.8rem;
    }
</style>

<div class="card mt-4 shadow-sm rounded-4 mx-auto" style="max-width: 480px;">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-pen-square me-1"></i> Edit Category</h5>
        <a href="{{ url('/admin/categories') }}" class="btn btn-danger btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>

    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger small mb-3">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ url('admin/categories/' . $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name">Category Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-select" required>
                        <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Show</option>
                        <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Hide</option>
                    </select>
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <input type="checkbox" id="popular" name="popular" value="1" class="form-check-input me-2" {{ old('popular', $category->popular) ? 'checked' : '' }}>
                    <label for="popular" class="form-check-label">Popular</label>
                </div>

                <div class="col-md-6">
                    <label for="image">Category Image</label>
                    <input id="image" type="file" name="image" class="form-control" accept="image/*">
                    @if ($category->image)
                        <img src="{{ asset($category->image) }}" alt="Image" class="preview">
                    @endif
                </div>

                <div class="col-12">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="3" class="form-control">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="col-12 mt-3">
                    <h6 class="text-primary"><i class="fas fa-search me-1"></i> SEO Details</h6>
                </div>

                <div class="col-md-4">
                    <label for="meta_title">Meta Title</label>
                    <input id="meta_title" type="text" name="meta_title" value="{{ old('meta_title', $category->meta_title) }}" class="form-control">
                </div>

                <div class="col-md-4">
                    <label for="meta_description">Meta Description</label>
                    <input id="meta_description" type="text" name="meta_description" value="{{ old('meta_description', $category->meta_description) }}" class="form-control">
                </div>

                <div class="col-md-4">
                    <label for="meta_keyword">Meta Keyword</label>
                    <input id="meta_keyword" type="text" name="meta_keyword" value="{{ old('meta_keyword', $category->meta_keyword) }}" class="form-control">
                </div>

                <div class="col-12 text-end mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
