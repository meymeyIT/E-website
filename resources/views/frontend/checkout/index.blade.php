@extends('layouts.frontend')

@section('content')
<div class="container py-5">
  <h3 class="text-primary text-center fw-bold mb-5">Checkout</h3>

  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <form method="POST" action="{{ route('checkout.place') }}">
    @csrf

    <div class="row g-4">
      {{-- Customer Info --}}
      <div class="col-md-6">
        <div class="card shadow-sm border-0 rounded-4 p-4">
          <h5 class="mb-4 text-primary">Customer Details</h5>

          <div class="mb-3">
            <label for="fullname" class="form-label fw-semibold">Full Name</label>
            <input id="fullname" type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror" 
                   required value="{{ old('fullname') }}" placeholder="Enter your full name">
            @error('fullname') 
              <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
          </div>

          <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                   required value="{{ old('email') }}" placeholder="Email">
            @error('email') 
              <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label fw-semibold">Phone</label>
            <input id="phone" type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                   required value="{{ old('phone') }}" placeholder="Phone">
            @error('phone') 
              <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
          </div>

          <div class="mb-3">
            <label for="address" class="form-label fw-semibold">Address</label>
            <textarea id="address" name="address" rows="3" 
                      class="form-control @error('address') is-invalid @enderror" required
                      placeholder="Enter your shipping address">{{ old('address') }}</textarea>
            @error('address') 
              <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
          </div>
        </div>
      </div>

      {{-- Order Summary --}}
      <div class="col-md-6">
        <div class="card shadow-sm border-0 rounded-4 p-4">
          <h5 class="mb-4 text-primary">Order Summary</h5>

          <ul class="list-group mb-3">
            @php $total = 0; @endphp
            @foreach($cart as $item)
              @php 
                $subtotal = $item['quantity'] * $item['price'];
                $total += $subtotal;
              @endphp
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                  <strong>{{ $item['name'] }}</strong><br>
                  <small class="text-muted">Qty: {{ $item['quantity'] }}</small>
                </div>
                <span class="fw-semibold">${{ number_format($subtotal, 2) }}</span>
              </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between fw-bold fs-5">
              <span>Total</span>
              <span>${{ number_format($total, 2) }}</span>
            </li>
          </ul>

          <button type="submit" class="btn btn-success btn-lg w-100">
            Place Order
          </button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection
