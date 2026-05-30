@extends('layouts.admin')

@section('content')
<div class="py-4" style="background-color: #eef1f5; min-height: 100vh;">
    <div class="container" style="max-width: 900px; font-family: 'Segoe UI', sans-serif;">
        <div class="card shadow border-0 rounded-4">
            <!-- Header -->
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
                <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Order Details</h5>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-light">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>

            <!-- Content -->
            <div class="card-body p-4 bg-white">
                <!-- Order Meta -->
                <div class="row g-4 mb-4">
                    <!-- Customer Info -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 shadow-sm h-100 bg-light">
                            <h6 class="text-primary mb-3"><i class="fas fa-user-circle me-1"></i>Customer Info</h6>
                            <ul class="list-unstyled small mb-0">
                                <li><strong>Name:</strong> {{ $order->user->name }}</li>
                                <li><strong>Email:</strong> {{ $order->user->email }}</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 shadow-sm h-100 bg-light">
                            <h6 class="text-primary mb-3"><i class="fas fa-file-invoice-dollar me-1"></i>Summary</h6>
                            <ul class="list-unstyled small mb-0">
                                <li><strong>Total:</strong> <span class="text-success">${{ number_format($order->total_price, 2) }}</span></li>
                                <li><strong>Status:</strong>
                                    <span class="badge 
                                        @if($order->order_status === 'pending') bg-warning text-dark
                                        @elseif($order->order_status === 'completed') bg-success
                                        @elseif($order->order_status === 'cancelled') bg-danger
                                        @else bg-secondary @endif">
                                        {{ ucfirst($order->order_status) }}
                                    </span>
                                </li>
                                <li><strong>Payment:</strong>
                                    <span class="badge 
                                        @if($order->payment_status === 'paid') bg-success
                                        @elseif($order->payment_status === 'unpaid') bg-danger
                                        @else bg-secondary @endif">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Product List -->
                <div class="bg-light border rounded-3 shadow-sm p-3">
                    <h6 class="text-primary mb-3"><i class="fas fa-boxes me-1"></i>Products</h6>
                    @if($order->items->count())
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless align-middle">
                                <thead class="text-muted border-bottom">
                                    <tr>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody class="small">
                                    @foreach ($order->items as $item)
                                        <tr class="border-bottom">
                                            <td>{{ $item->product->name ?? 'N/A' }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td class="text-success fw-semibold">
                                                ${{ number_format($item->quantity * $item->price, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted small">No products found in this order.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
