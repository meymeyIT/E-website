@extends('layouts.admin')

@section('content')
{{-- Title centered --}}
<h1 class="h3 text-primary fw-bold mb-5 text-center">Sales Report</h1>

<form method="GET" action="{{ route('admin.reports.sales') }}" class="mb-5">
    <div class="row g-4 align-items-end justify-content-center">
        <div class="col-md-3">
            <label for="start_date" class="form-label fw-semibold text-secondary">Start Date</label>
            <input 
                type="date" 
                id="start_date" 
                name="start_date" 
                value="{{ $startDate }}" 
                class="form-control form-control-lg border-primary shadow-sm"
            >
        </div>

        <div class="col-md-3">
            <label for="end_date" class="form-label fw-semibold text-secondary">End Date</label>
            <input 
                type="date" 
                id="end_date" 
                name="end_date" 
                value="{{ $endDate }}" 
                class="form-control form-control-lg border-primary shadow-sm"
            >
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary btn-lg shadow w-100" type="submit">
                <i class="bi bi-funnel-fill me-2"></i> Filter
            </button>
        </div>
    </div>
</form>

@if($salesData->count() > 0)
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-bordered align-middle mb-0 text-center">
            <thead class="table-primary text-primary">
                <tr>
                    <th>Date</th>
                    <th>Orders Count</th>
                    <th>Total Sales</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salesData as $sale)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($sale->date)->format('M d, Y') }}</td>
                        <td>{{ $sale->orders_count }}</td>
                        <td class="fw-semibold">${{ number_format($sale->total_sales, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $salesData->links() }}
    </div>
@else
    <p class="text-muted fst-italic text-center">No sales data found for the selected dates.</p>
@endif

@endsection
