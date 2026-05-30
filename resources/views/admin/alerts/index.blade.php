@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 fw-bold fs-4 d-flex align-items-center">
        System Alerts
        <span class="badge bg-danger ms-3 fs-7 py-1 px-3 rounded-pill">{{ count($alerts) }}</span>
    </h1>

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-light rounded-3 p-3 mb-0 small">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Alerts</li>
        </ol>
    </nav>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
            <span class="fw-semibold fs-6">Recent System Alerts</span>
            <form action="{{ route('admin.alerts.readAll') }}" method="POST" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-primary px-4 rounded-pill">
                    Mark All as Read
                </button>
            </form>
        </div>

        <div class="card-body px-0">
            @if($alerts->count() > 0)
                <ul class="list-group list-group-flush">
                    @foreach($alerts as $alert)
                        <li class="list-group-item px-4 py-3 @if(!$alert->is_read) alert-unread @endif">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="me-4 flex-grow-1">
                                    <h5 class="mb-1 fw-bold text-dark">{{ $alert->title }}</h5>
                                    <p class="mb-2 text-muted small lh-base">{{ Str::limit($alert->message, 100) }}</p>
                                    <ul class="list-unstyled mb-0 small text-secondary lh-sm">
                                        @if(!empty($alert->name)) <li><strong>Name:</strong> {{ $alert->name }}</li> @endif
                                        @if(!empty($alert->email)) <li><strong>Email:</strong> {{ $alert->email }}</li> @endif
                                        @if(!empty($alert->subject)) <li><strong>Subject:</strong> {{ $alert->subject }}</li> @endif
                                    </ul>
                                </div>
                                <span class="badge rounded-pill fs-7
                                    {{ $alert->status === 'new' ? 'bg-danger pulse' : 'bg-secondary' }}">
                                    {{ ucfirst($alert->status) }}
                                </span>
                            </div>

                            <div class="d-flex justify-content-between small text-muted border-top pt-2">
                                <span>From: <strong>{{ $alert->user->name ?? 'System' }}</strong></span>
                                <span>{{ $alert->created_at->format('M d, Y H:i') }}</span>
                            </div>

                            @if(!$alert->is_read)
                                <form action="{{ route('admin.alerts.read', $alert->id) }}" method="POST" class="mt-3">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success px-4 rounded-pill">
                                        Mark as Read
                                    </button>
                                </form>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="text-center text-muted py-5 small">
                    <i class="bi bi-bell-slash fs-2 mb-3"></i><br>
                    No alerts available.
                </div>
            @endif
        </div>

        <div class="card-footer text-end bg-white border-top">
            <a href="{{ url('/admin/dashboard') }}" class="btn btn-sm btn-outline-primary px-4 rounded-pill">
                Back to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.pulse {
    animation: pulse 1.3s infinite;
    font-size: 0.75rem !important;
}
@keyframes pulse {
    0%, 100% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.15);
        opacity: 0.7;
    }
}

/* Highlight unread alerts */
.alert-unread {
    background-color: #fff9e6 !important; /* pale yellow background */
    border-left: 5px solid #ffc107; /* bright amber highlight */
    box-shadow: 0 1px 5px rgba(255, 193, 7, 0.4); /* subtle amber glow */
    transition: box-shadow 0.3s ease, background-color 0.3s ease;
}

/* Hover effect for unread alerts */
.alert-unread:hover {
    box-shadow: 0 4px 12px rgba(255, 193, 7, 0.7); /* stronger glow on hover */
    background-color: #fff8dc;
}

/* Smooth hover effect for all list items */
.list-group-item {
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
}

.list-group-item:hover {
    background-color: #f8f9fa; /* light gray on hover */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* subtle shadow on hover */
}

/* Buttons hover effect */
.btn-outline-primary:hover {
    background-color: #0d6efd;
    color: white;
    border-color: #0d6efd;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.btn-outline-success:hover {
    background-color: #198754;
    color: white;
    border-color: #198754;
    transition: background-color 0.3s ease, color 0.3s ease;
}
</style>
@endpush
