@extends('layouts.admin')

@section('content')
<div class="card shadow-sm rounded-4">
    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
        <h5 class="mb-0 fw-semibold">
            Images for <strong>{{ $product->name }}</strong>
        </h5>
        <a href="{{ route('admin.products.images.create', $product->slug) }}" 
           class="btn btn-sm btn-light d-flex align-items-center gap-1">
            <i class="fas fa-plus"></i> Add Images
        </a>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show small" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($product->images->count() > 0)
            <div class="row g-3">
                @foreach($product->images as $image)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                        <div class="card h-100 border rounded shadow-sm position-relative overflow-hidden">
                            <img 
                                src="{{ asset('uploads/product_images/' . $image->image) }}" 
                                alt="Image of {{ $product->name }}" 
                                class="card-img-top rounded-top cursor-pointer"
                                style="object-fit: cover; height: 130px; width: 100%; transition: transform 0.3s ease;"
                                loading="lazy"
                                data-bs-toggle="modal" 
                                data-bs-target="#imageModal" 
                                data-image="{{ asset('uploads/product_images/' . $image->image) }}"
                                title="Click to view full image"
                                onmouseover="this.style.transform='scale(1.05)';"
                                onmouseout="this.style.transform='scale(1)';"
                            >
                            <div class="card-body p-2 d-flex justify-content-center">
                                <form 
                                    action="{{ route('admin.products.images.destroy', [$product->slug, $image->id]) }}" 
                                    method="POST" 
                                    onsubmit="return confirm('Are you sure you want to delete this image?');"
                                    class="w-100"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100 d-flex align-items-center justify-content-center gap-1" title="Delete Image">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-muted py-5">
                <i class="fas fa-image fa-3x mb-3"></i>
                <p class="lead mb-3">No Images Found for this product.</p>
                <a href="{{ route('admin.products.images.create', $product->slug) }}" class="btn btn-outline-primary btn-sm d-inline-flex align-items-center gap-2">
                    <i class="fas fa-plus"></i> Upload Images
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Modal for full image view -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0 shadow-none">
      <div class="modal-body p-0">
        <img src="" alt="Full Image" id="modalImage" class="img-fluid rounded" style="width: 100%; height: auto; user-select:none;">
      </div>
      <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');

    imageModal.addEventListener('show.bs.modal', event => {
        const triggerImg = event.relatedTarget;
        modalImage.src = triggerImg.getAttribute('data-image');
    });

    imageModal.addEventListener('hidden.bs.modal', () => {
        modalImage.src = '';
    });
</script>
@endpush
