@extends('layouts.admin')

@section('content')
<div class="card mt-4 shadow border-0 rounded-3" style="max-width: 480px; margin: 2rem auto;">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-2 px-3">
        <h5 class="mb-0 fw-semibold" style="font-size: 1.1rem;">
            Add Images for: <strong>{{ $product->name }}</strong>
        </h5>

        <a href="{{ route('admin.products.images.index', $product->slug) }}" 
           class="btn btn-sm btn-outline-light p-1 d-flex align-items-center gap-1" 
           style="font-size: 0.8rem;">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card-body p-3">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show py-1" role="alert" style="font-size: 0.85rem;">
                <strong>Whoops!</strong> Please fix the errors below:
                <ul class="mb-0 mt-1 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('admin.products.images.store', $product->slug) }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="mb-3">
                <label for="images" class="form-label fw-semibold" style="font-size: 0.9rem;">
                    Select Images <small class="text-muted">(multiple allowed)</small>
                </label>
                <input 
                    type="file" 
                    name="images[]" 
                    id="images" 
                    class="form-control form-control-sm @error('images') is-invalid @enderror" 
                    accept="image/*" 
                    multiple
                    aria-describedby="imagesHelp"
                    style="font-size: 0.85rem;"
                >
                <div id="imagesHelp" class="form-text" style="font-size: 0.75rem;">JPG, PNG, GIF supported</div>

                @error('images')
                    <div class="invalid-feedback" style="font-size: 0.8rem;">{{ $message }}</div>
                @enderror
                @error('images.*')
                    <div class="invalid-feedback" style="font-size: 0.8rem;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center gap-1" style="font-size: 0.85rem;">
                <i class="fas fa-upload"></i> Upload
            </button>
        </form>
    </div>
</div>
@endsection
