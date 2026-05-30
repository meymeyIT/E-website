@extends('layouts.frontend')

@section('content')
{{-- Carousel --}}
<div id="carouselExample" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-interval="3500" style="max-height: 450px; overflow: hidden;">
  <div class="carousel-inner rounded shadow-sm">
    <div class="carousel-item active">
      <img src="{{ asset('assets/images/slider1.jpg') }}" class="d-block w-100" alt="Slide 1" style="object-fit: cover; height: 450px;">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('assets/images/slider2.jpg') }}" class="d-block w-100" alt="Slide 2" style="object-fit: cover; height: 450px;">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('assets/images/slider3.jpg') }}" class="d-block w-100" alt="Slide 3" style="object-fit: cover; height: 450px;">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon bg-dark rounded-circle p-3"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon bg-dark rounded-circle p-3"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

{{-- Categories Section --}}
<div class="container mb-5">
  <div class="text-center mb-5">
    <h2 class="fw-bold text-primary">Explore Our Categories</h2>
    <p class="text-muted fs-5">Browse products by category and discover what you need.</p>
  </div>

  @if($categories->isNotEmpty())
    <div class="row g-4">
      @foreach ($categories as $category)
        @php
          $imgPath = $category->image ? public_path($category->image) : null;
          $imgUrl  = ($imgPath && file_exists($imgPath)) ? asset($category->image) : asset('assets/images/no-image.png');
        @endphp

        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <div class="card h-100 shadow-sm border-0 text-center p-4 category-card rounded-4" role="group" aria-label="Category {{ $category->name }}">
            <div class="mb-4 d-flex justify-content-center">
              <img
                src="{{ $imgUrl }}"
                alt="{{ $category->name }}"
                title="{{ $category->name }}"
                loading="lazy"
                class="rounded-circle category-image border border-3"
                width="180"
                height="180"
              />
            </div>

            <div class="card-body d-flex flex-column">
              <h5 class="card-title fw-semibold mb-3 text-truncate fs-5" title="{{ $category->name }}">{{ $category->name }}</h5>

              <a href="{{ route('categories.show', $category->slug) }}"
                 class="btn btn-outline-primary mt-auto w-100 rounded-pill fw-semibold py-3 fs-6"
                 aria-label="View products in {{ $category->name }}">
                View Products
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <div class="row">
      <div class="col-12 text-center py-5">
        <i class="fas fa-folder-open fa-3x text-muted mb-3" aria-hidden="true"></i>
        <p class="text-muted fs-5">No categories found.</p>
      </div>
    </div>
  @endif
</div>

<style>
  /* Category image */
  .category-image {
    object-fit: cover;
    width: 180px;
    height: 180px;
    transition: transform 0.28s ease, box-shadow 0.28s ease;
    border-radius: 50%;
  }

  /* Card hover & focus */
  .category-card {
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    cursor: pointer;
    padding: 1.25rem;
  }
  .category-card:hover,
  .category-card:focus-within {
    transform: translateY(-6px);
    box-shadow: 0 14px 30px rgba(2, 6, 23, 0.08);
  }

  /* Image subtle scale on hover */
  .category-card:hover .category-image,
  .category-card:focus-within .category-image {
    transform: scale(1.03);
  }

  /* Truncate long titles */
  .text-truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  /* Button focus for accessibility */
  .btn:focus-visible {
    outline: 3px solid rgba(13,110,253,0.18);
    outline-offset: 3px;
  }

  /* Responsive tweaks */
  @media (max-width: 420px) {
    .category-image { width: 140px; height: 140px; }
    .category-card { padding: 1rem; }
  }
</style>


{{-- Products Section --}}
<div class="container mb-5">
  <h2 class="text-center text-primary fw-bold mb-5">Latest Products</h2>
  <div class="row g-4">
    @forelse ($products as $product)
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card h-100 shadow border-0 rounded-4 overflow-hidden transition-shadow">
          @if($product->image && file_exists(public_path($product->image)))
            <img src="{{ asset($product->image) }}" class="card-img-top product-img" alt="{{ $product->name }}">
          @else
            <img src="{{ asset('assets/images/no-image.png') }}" class="card-img-top product-img" alt="No image">
          @endif
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-truncate" title="{{ $product->name }}">{{ $product->name }}</h5>
            <p class="card-text text-muted small mb-2">
              <span class="me-3"><strong>Brand:</strong> {{ $product->brand?->name ?? 'N/A' }}</span>
              <span><strong>Category:</strong> {{ $product->category?->name ?? 'N/A' }}</span>
            </p>
            <p class="fw-bold text-primary fs-5 mt-auto">${{ number_format($product->selling_price, 2) }}</p>
          </div>

          <div class="card-footer bg-white border-0 d-flex gap-2 pt-3">
            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline-primary flex-fill rounded-pill d-flex align-items-center justify-content-center gap-2 fw-semibold py-2">
              <i class="fas fa-eye"></i> View
            </a>

            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-fill m-0">
              @csrf
              <button type="submit" class="btn btn-primary w-100 rounded-pill d-flex align-items-center justify-content-center gap-2 fw-semibold py-2">
                <i class="fas fa-shopping-cart"></i> Buy
              </button>
            </form>
          </div>
        </div>
      </div>
    @empty
      <p class="text-center text-muted fs-5">No products available at the moment.</p>
    @endforelse
  </div>

  {{-- Pagination --}}
  <div class="d-flex justify-content-center mt-5">
    {{ $products->links('pagination::bootstrap-5') }}
  </div>
</div>

{{-- Footer --}}
<footer class="mt-5 pt-5 pb-5 bg-dark text-white">
  <div class="container rounded-4 overflow-hidden shadow-lg">
    <div class="row gy-5">
      <div class="col-md-4 footer-col-about p-4">
        <h5 class="mb-4 fw-bold text-uppercase border-bottom border-2 border-primary pb-2">About Us</h5>
        <p class="small text-white-75">
          We provide quality products with the best prices. Thank you for shopping with us!
        </p>
      </div>

      <div class="col-md-4 footer-col-links p-4">
        <h5 class="mb-4 fw-bold text-uppercase border-bottom border-2 border-primary pb-2">Quick Links</h5>
        <ul class="list-unstyled">
          <li class="mb-3">
            <a href="{{ url('/') }}" class="text-white text-decoration-none hover-underline">Home</a>
          </li>
          <li class="mb-3">
            <a href="{{ route('products.index') }}" class="text-white text-decoration-none hover-underline">Products</a>
          </li>
          <li class="mb-3">
            <a href="{{ route('contact.show') }}" class="text-white text-decoration-none hover-underline">Contact Us</a>
          </li>
          <li class="mb-3">
            <a href="{{ route('about') }}" class="text-white text-decoration-none hover-underline">About</a>
          </li>
        </ul>
      </div>

      <div class="col-md-4 footer-col-contact p-4">
        <h5 class="mb-4 fw-bold text-uppercase border-bottom border-2 border-primary pb-2">Contact</h5>
        <p class="small mb-3">
          Email: <a href="mailto:support@example.com" class="text-white text-decoration-none">support@example.com</a><br>
          Phone: <a href="tel:+1234567890" class="text-white text-decoration-none">+1 234 567 890</a><br>
          Address: 123 Market St, City, Country
        </p>
        <div class="d-flex gap-4 fs-4">
          <a href="#" class="text-white" aria-label="Facebook" title="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="text-white" aria-label="Twitter" title="Twitter"><i class="fab fa-twitter"></i></a>
          <a href="#" class="text-white" aria-label="Instagram" title="Instagram"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>

    <hr class="border-light my-4" />

    <div class="text-center small text-white-50 mb-2">
      &copy; {{ date('Y') }} Your Company Name. All rights reserved.
    </div>
  </div>

  <style>
    /* Product image hover zoom */
    .product-img {
      height: 220px;
      object-fit: cover;
      transition: transform 0.4s ease;
      will-change: transform;
      cursor: pointer;
      border-radius: 0.5rem;
    }
    .product-img:hover {
      transform: scale(1.08);
    }

    /* Card shadow hover */
    .transition-shadow:hover,
    .category-card:hover {
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
      transition: box-shadow 0.3s ease;
      transform: translateY(-6px);
    }

    /* Buttons with icons alignment */
    .btn > i {
      transition: transform 0.3s ease;
    }
    .btn:hover > i {
      transform: translateX(5px);
    }

    /* Button smooth hover */
    .btn {
      transition: background-color 0.3s ease, opacity 0.3s ease, color 0.3s ease;
      font-weight: 600;
    }
    .btn:hover {
      opacity: 0.9;
      text-decoration: none;
    }

    /* Footer columns colors */
    .footer-col-about {
      background: #212529;
    }
    .footer-col-links {
      background: #2c3035;
    }
    .footer-col-contact {
      background: #343a40;
    }

    /* Footer links hover */
    .hover-underline:hover {
      text-decoration: underline !important;
    }
    a.text-white:hover {
      color: #0dcaf0 !important; /* Bootstrap cyan accent */
      transition: color 0.3s ease;
    }

    /* Responsive footer padding */
    @media (max-width: 767.98px) {
      .row.gy-5 > div {
        padding-left: 1rem !important;
        padding-right: 1rem !important;
      }
    }
  </style>
</footer>
@endsection
