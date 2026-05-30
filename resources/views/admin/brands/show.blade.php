@extends('layouts.admin')

@section('content')

<div class="card mt-5 shadow-lg rounded-4" style="max-width: 520px; margin: 3rem auto; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white rounded-top px-4 py-3" style="box-shadow: inset 0 -3px 5px rgba(0,0,0,0.15);">
        <h4 class="mb-0 fw-bold" style="letter-spacing: 0.04em; font-size: 1.35rem; text-transform: uppercase;">Brand Details</h4>
        <a href="{{ url('/admin/brands') }}" class="btn btn-light btn-sm shadow-sm px-3 py-1" style="font-weight: 700; font-size: 0.9rem; letter-spacing: 0.02em; transition: background-color 0.3s ease;">
            <i class="fas fa-arrow-left me-1"></i> Back to Brands
        </a>
    </div>

    <div class="card-body bg-white p-4 rounded-bottom" style="line-height: 1.5;">
        <dl class="row g-3 mb-0">
            <dt class="col-sm-4 text-secondary fw-semibold" style="font-size: 0.95rem; letter-spacing: 0.015em;">ID</dt>
            <dd class="col-sm-8 fs-5 fw-semibold" style="font-size: 1.15rem; color: #1a1a1a;">{{ $brand->id }}</dd>

            <dt class="col-sm-4 text-secondary fw-semibold" style="font-size: 0.95rem; letter-spacing: 0.015em;">Name</dt>
            <dd class="col-sm-8 fs-5 fw-semibold" style="font-size: 1.15rem; color: #1a1a1a;">{{ $brand->name }}</dd>

            <dt class="col-sm-4 text-secondary fw-semibold" style="font-size: 0.95rem; letter-spacing: 0.015em;">Active</dt>
            <dd class="col-sm-8" style="padding-top: 0.2rem;">
                <span class="badge {{ $brand->is_active ? 'bg-success' : 'bg-secondary' }} fs-6 px-4 py-1 rounded-pill shadow-sm" style="font-weight: 700; letter-spacing: 0.02em; text-transform: uppercase;">
                    {{ $brand->is_active ? 'Yes' : 'No' }}
                </span>
            </dd>

            @if($brand->image)
            <dt class="col-sm-4 text-secondary fw-semibold" style="font-size: 0.95rem; letter-spacing: 0.015em; cursor: pointer;">Image</dt>
            <dd class="col-sm-8" style="padding-top: 0.2rem;">
                <img src="{{ asset($brand->image) }}" alt="Brand Image" 
                     class="img-fluid rounded shadow-sm border" 
                     style="max-width: 220px; height: auto; object-fit: contain; box-shadow: 0 4px 10px rgba(0,0,0,0.12); cursor: pointer;"
                     data-bs-toggle="modal" data-bs-target="#brandImageModal">
            </dd>
            @endif
        </dl>
    </div>
</div>

<!-- Modal -->
@if($brand->image)
<div class="modal fade" id="brandImageModal" tabindex="-1" aria-labelledby="brandImageModalLabel" aria-hidden="true" data-bs-backdrop="true" data-bs-keyboard="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content rounded-4 border-0 shadow-lg">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="brandImageModalLabel">{{ $brand->name }} - Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <img src="{{ asset($brand->image) }}" alt="Brand Image Large" class="img-fluid rounded-bottom w-100" style="object-fit: contain;">
      </div>
    </div>
  </div>
</div>
@endif

<style>
    .card-header {
        border-bottom: none;
        background-image: linear-gradient(45deg, #1c62d1, #1454a6);
        box-shadow: inset 0 -4px 8px rgba(0,0,0,0.25);
    }
    dt, dd {
        margin-bottom: 0 !important;
        padding: 0.25rem 0;
    }
    dt {
        font-variant: small-caps;
    }
    dd {
        color: #222;
    }
    a.btn-light:hover {
        background-color: #e9ecef;
        color: #1c62d1;
        box-shadow: 0 3px 8px rgba(28, 98, 209, 0.5);
    }
</style>

@endsection
