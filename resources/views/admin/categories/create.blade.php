@extends('layouts.admin')

@section('content')
<div class="py-4" style="background-color: #f4f7f6; min-height: 100vh;">
    <div class="container" style="max-width: 860px; font-family: 'Segoe UI', sans-serif;">
        <div class="card shadow-sm rounded-4 border-0">
            <!-- Header -->
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3 px-4 rounded-top-4">
                <h5 class="mb-0">➕ Add New Category</h5>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>

            <!-- Form Body -->
            <div class="card-body bg-white p-4 rounded-bottom-4">
                @if ($errors->any())
                    <div class="alert alert-danger rounded-3">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li class="small">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label text-primary fw-semibold">📛 Category Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter category name" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label text-primary fw-semibold">📝 Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Enter description..."></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-primary fw-semibold">🔘 Status</label>
                            <select name="status" class="form-select">
                                <option value="">--- Select Status ---</option>
                                <option value="1">Show</option>
                                <option value="0">Hide</option>
                            </select>
                        </div>

                        <div class="col-md-6 d-flex align-items-end">
                            <div class="form-check mt-3">
                                <input type="checkbox" name="popular" class="form-check-input" id="popularCheck" value="1">
                                <label for="popularCheck" class="form-check-label text-primary">⭐ Mark as Popular</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-primary fw-semibold">🖼️ Category Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="col-12 mt-4">
                            <h6 class="text-primary fw-bold border-bottom pb-1">🔍 SEO Details</h6>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label text-primary fw-semibold">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" placeholder="Enter meta title">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-primary fw-semibold">Meta Description</label>
                            <input type="text" name="meta_description" class="form-control" placeholder="Enter meta description">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-primary fw-semibold">Meta Keywords</label>
                            <input type="text" name="meta_keyword" class="form-control" placeholder="Enter meta keywords">
                        </div>

                        <div class="col-md-12 text-end mt-4">
                            <button type="submit" class="btn btn-success px-5">
                                <i class="fas fa-check-circle me-1"></i> Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div>
</div>
@endsection
