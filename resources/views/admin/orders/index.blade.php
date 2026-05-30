@extends('layouts.admin')

@section('content')
<div class="card shadow-sm border-0 mt-4" style="font-family: 'Segoe UI', sans-serif;">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Orders List</h4>
    </div>

    <div class="card-body bg-light">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle shadow-sm bg-white rounded">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Order Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td class="text-success fw-bold">${{ number_format($order->total_price, 2) }}</td>
                            <td>
                                <span class="badge 
                                    @if($order->order_status === 'pending') bg-warning text-dark
                                    @elseif($order->order_status === 'completed') bg-success
                                    @elseif($order->order_status === 'cancelled') bg-danger
                                    @else bg-info text-dark @endif">
                                    {{ ucfirst($order->order_status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                   class="btn btn-outline-primary btn-sm" title="View Order #{{ $order->id }}">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
