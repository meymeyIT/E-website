@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <h3 class="mb-4 text-primary fw-bold">Your Shopping Cart</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(count($cart) > 0)
        <div class="table-responsive shadow-sm rounded">
            <table class="table align-middle mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th class="text-start">Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                        <tr class="text-center">
                            <td class="text-start d-flex align-items-center gap-3">
                                <img src="{{ asset($item['image'] ?: 'assets/images/no-image.png') }}" alt="{{ $item['name'] }}" width="60" height="60" class="rounded border">
                                <span class="fw-semibold">{{ $item['name'] }}</span>
                            </td>
                            <td class="fw-semibold">${{ number_format($item['price'], 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('cart.update', $id) }}" class="d-flex justify-content-center align-items-center gap-2">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm" style="width: 70px;">
                                    <button type="submit" class="btn btn-sm btn-primary" title="Update Quantity">Update</button>
                                </form>
                            </td>
                            <td class="fw-bold text-success">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('cart.remove', $id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" title="Remove Item" onclick="return confirm('Are you sure you want to remove this item?');">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="table-active text-center">
                        <td colspan="3" class="text-end fw-bold fs-5">Total:</td>
                        <td colspan="2" class="fw-bold fs-5 text-success">
                            ${{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)), 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('checkout.index') }}" class="btn btn-lg btn-success px-4 shadow">
                Proceed to Checkout
            </a>
        </div>
    @else
        <div class="alert alert-info text-center fs-5">
            Your cart is empty.
        </div>
    @endif
</div>
@endsection
