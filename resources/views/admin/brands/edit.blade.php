@extends('layouts.admin')

@section('content')

<div class="card mt-4 shadow-sm rounded-4" style="max-width: 460px; margin: 2rem auto;">
    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white rounded-top">
        <h5 class="mb-0 fw-semibold" style="font-size: 1.2rem;">Edit Brand</h5>
        <a href="{{ url('/admin/brands') }}" class="btn btn-danger btn-sm px-3 py-1" style="font-size: 0.85rem;">Back</a>
    </div>

    <div class="card-body bg-white p-3 rounded-bottom">
        @if ($errors->any())
            <div class="alert alert-danger rounded-3 py-2 px-3 mb-3" style="font-size: 0.85rem;">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('admin/brands/' . $brand->id) }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label" style="font-size: 0.9rem; font-weight: 600; color: #2c3e50;">Brand Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $brand->name) }}" 
                       class="form-control" placeholder="Enter brand name" required 
                       style="font-size: 0.9rem; padding: 8px 10px; border-radius: 0.4rem;"/>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label" style="font-size: 0.9rem; font-weight: 600; color: #2c3e50;">Brand Logo/Image</label>
                <input type="file" name="image" id="image" class="form-control" style="padding: 6px 10px; font-size: 0.9rem;"/>
                @if ($brand->image)
                    <div class="mt-2">
                        <img src="{{ asset($brand->image) }}" class="image-preview" alt="Brand Image">
                    </div>
                @endif
            </div>

            <div class="form-check mb-4">
                <input type="checkbox" name="is_active" id="is_active" value="1" class="form-check-input"
                       {{ old('is_active', $brand->is_active) == 1 ? 'checked' : '' }} style="transform: scale(0.9);">
                <label for="is_active" class="form-check-label" style="font-size: 0.9rem;">Active Status</label>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary px-4 py-2" style="font-size: 0.95rem; font-weight: 600;">
                    Update Brand
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

<style>
    .card-header {
        background-color: #1c62d1;
        color: #fff;
        font-weight: 700;
    }
    label {
        color: #2c3e50;
        font-weight: 600;
    }
    .form-control {
        border-radius: 0.4rem;
        border: 1.5px solid #d1d1d1;
        font-size: 0.9rem;
        padding: 8px 10px;
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .form-control:focus {
        border-color: #1c62d1;
        box-shadow: 0 0 6px rgba(28, 98, 209, 0.3);
        outline: none;
    }
    .btn-primary {
        background-color: #1c62d1;
        border: none;
        border-radius: 0.4rem;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #1449a6;
    }
    .btn-danger {
        border-radius: 0.4rem;
        font-size: 0.85rem;
        padding: 5px 14px;
    }
    .image-preview {
        border: 1px solid #ccc;
        border-radius: 0.4rem;
        max-width: 110px;
        max-height: 110px;
        object-fit: contain;
        background-color: #f8f9fa;
        padding: 5px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
</style>
