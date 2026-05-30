@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4 fw-bold">Admin Dashboard</h1>

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-light rounded-3 p-2 mb-0">
            <li class="breadcrumb-item active" aria-current="page">Overview & Statistics</li>
        </ol>
    </nav>

    <div class="row g-4 mb-4">
        {{-- Users --}}
        <div class="col-xl-3 col-md-6">
            <a href="{{ url('/admin/users') }}" class="text-decoration-none">
                <div class="card bg-primary text-white h-100 shadow-sm border-0 rounded-4 hover-scale">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="fw-bold mb-1">{{ $totalUsers ?? 0 }}</h2>
                            <p class="mb-0 text-uppercase fw-semibold small opacity-75">Users</p>
                        </div>
                        <i class="fas fa-users fa-3x opacity-75"></i>
                    </div>
                    <div class="card-footer bg-primary bg-opacity-75 d-flex justify-content-between align-items-center small rounded-bottom-4">
                        <span>View All</span> 
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </a>
        </div>

        {{-- Pending Orders --}}
        <div class="col-xl-3 col-md-6">
            <a href="{{ url('/admin/orders') }}" class="text-decoration-none">
                <div class="card bg-warning text-dark h-100 shadow-sm border-0 rounded-4 hover-scale">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="fw-bold mb-1">{{ $pendingOrders ?? 0 }}</h2>
                            <p class="mb-0 text-uppercase fw-semibold small opacity-75">Pending Orders</p>
                        </div>
                        <i class="fas fa-shopping-cart fa-3x opacity-75"></i>
                    </div>
                    <div class="card-footer bg-warning bg-opacity-75 d-flex justify-content-between align-items-center small rounded-bottom-4">
                        <span>View All</span>
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </a>
        </div>

        {{-- Monthly Revenue --}}
        <div class="col-xl-3 col-md-6">
            <a href="{{ url('/admin/reports/sales') }}" class="text-decoration-none">
                <div class="card bg-success text-white h-100 shadow-sm border-0 rounded-4 hover-scale">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="fw-bold mb-1">${{ number_format($monthlyRevenue ?? 0, 2) }}</h2>
                            <p class="mb-0 text-uppercase fw-semibold small opacity-75">Monthly Revenue</p>
                        </div>
                        <i class="fas fa-dollar-sign fa-3x opacity-75"></i>
                    </div>
                    <div class="card-footer bg-success bg-opacity-75 d-flex justify-content-between align-items-center small rounded-bottom-4">
                        <span>View Report</span>
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </a>
        </div>

        {{-- System Alerts --}}
        <div class="col-xl-3 col-md-6">
    <a href="{{ url('/admin/alerts') }}" class="text-decoration-none">
        <div class="card bg-info text-white h-100 shadow-sm border-0 rounded-4 hover-scale">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold mb-1">{{ $systemAlertsCount ?? 0 }}</h2>
                    <p class="mb-0 text-uppercase fw-semibold small opacity-75">System Alerts</p>
                </div>
                <i class="fas fa-exclamation-triangle fa-3x opacity-75"></i>
            </div>
            <div class="card-footer bg-info bg-opacity-75 d-flex justify-content-between align-items-center small rounded-bottom-4">
                <span>{{ ($systemAlertsCount ?? 0) > 0 ? 'View Alerts' : 'No Alerts' }}</span>
                <i class="fas fa-info-circle"></i>
            </div>
        </div>
    </a>
</div>

</div>
@endsection

@push('styles')
<style>
    .hover-scale {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .hover-scale:hover {
        transform: translateY(-5px) scale(1.03);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }
</style>
@endpush
