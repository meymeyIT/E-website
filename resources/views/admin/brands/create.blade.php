@extends('layouts.admin')

@section('content')
<div class="card mt-3 shadow rounded" style="max-width: 480px; margin: 1.5rem auto;">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-2 px-3">
        <h6 class="mb-0">Add Brand</h6>
        <a href="{{ url('/admin/brands') }}" class="btn btn-light btn-sm py-0 px-2">← Back</a>
    </div>

    <div class="card-body py-3 px-3">
        @if ($errors->any())
            <div class="alert alert-danger py-2 px-3 mb-3" style="font-size: 0.85rem;">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('admin/brands') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-2">
                <label for="name" class="form-label small mb-1">Brand Name</label>
                <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Enter brand name" required>
            </div>

            <div class="mb-2">
                <label for="image" class="form-label small mb-1">Brand Logo/Image</label>
                <input type="file" name="image" id="image" class="form-control form-control-sm" accept="image/*">
            </div>

            <div class="form-check mb-2">
                <input type="checkbox" name="is_active" id="activeCheck" class="form-check-input" value="1" style="transform: scale(0.85);">
                <label for="activeCheck" class="form-check-label small">Active</label>
            </div>

            <button type="submit" class="btn btn-success btn-sm px-3 py-1">Submit</button>
        </form>
    </div>
</div>
@endsection
