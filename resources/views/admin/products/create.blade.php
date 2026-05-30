@extends('layouts.admin')

@section('content')
<div class="card mt-4 shadow-sm rounded-4" style="max-width:700px; margin:auto;">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-2 px-3">
        <h5 class="mb-0">Add Product</h5>
        <a href="{{ url('/admin/products') }}" class="btn btn-light btn-sm">← Back</a>
    </div>

    <div class="card-body p-3">
        @if ($errors->any())
            <div class="alert alert-danger rounded-3 py-2 px-3 mb-3">
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Product Name</label>
                    <input type="text" name="name" class="form-control form-control-sm" placeholder="Enter product name" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Category</label>
                    <select name="category_id" class="form-select form-select-sm" required>
                        <option value="" disabled selected>--- Select Category ---</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Brand</label>
                    <select name="brand_id" class="form-select form-select-sm" required>
                        <option value="" disabled selected>--- Select Brand ---</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Original Price</label>
                    <input type="number" name="original_price" class="form-control form-control-sm" placeholder="Original price" min="0" step="0.01" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Selling Price</label>
                    <input type="number" name="selling_price" class="form-control form-control-sm" placeholder="Selling price" min="0" step="0.01" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Quantity</label>
                    <input type="number" name="quantity" class="form-control form-control-sm" placeholder="Quantity" min="0" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Image</label>
                    <input type="file" name="image" class="form-control form-control-sm" accept="image/*">
                </div>

                <div class="col-md-6 d-flex align-items-center gap-3 mt-1">
                    <div class="form-check">
                        <input type="hidden" name="is_trending" value="0">
                        <input type="checkbox" name="is_trending" id="trendingCheck" class="form-check-input form-check-input-sm" value="1" {{ old('is_trending') ? 'checked' : '' }}>
                        <label for="trendingCheck" class="form-check-label small">Trending</label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" id="activeCheck" class="form-check-input form-check-input-sm" value="1" checked>
                        <label for="activeCheck" class="form-check-label small">Active</label>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <label class="form-label small fw-semibold">Short Description</label>
                    <textarea name="small_description" class="form-control form-control-sm" rows="2" placeholder="Short description..."></textarea>
                </div>

                <div class="col-12 mt-2">
                    <label class="form-label small fw-semibold">Description</label>
                    <textarea name="description" class="form-control form-control-sm" rows="3" placeholder="Full product description..."></textarea>
                </div>

                <div class="col-12 mt-3">
                    <h6 class="fw-semibold">SEO Details</h6>
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control form-control-sm" placeholder="Meta title">
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Meta Description</label>
                    <input type="text" name="meta_description" class="form-control form-control-sm" placeholder="Meta description">
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Meta Keyword</label>
                    <input type="text" name="meta_keyword" class="form-control form-control-sm" placeholder="Meta keywords">
                </div>

                <div class="col-12 text-end mt-3">
                    <button type="submit" class="btn btn-success btn-sm px-4">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
