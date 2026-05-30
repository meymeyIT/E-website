@extends('layouts.frontend')

@section('content')
<div class="container py-4">
    @if ($about)
        {{-- Title --}}
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary">{{ $about->title }}</h2>
            <div class="mx-auto mt-2 mb-3" style="width: 50px; height: 3px; background-color: #0d6efd; border-radius: 3px;"></div>
        </div>

        {{-- Content Section --}}
        <div class="row align-items-center justify-content-center gy-3">
            @if($about->image && file_exists(public_path($about->image)))
                <div class="col-12 col-sm-4 text-center">
                    <img src="{{ asset($about->image) }}"
                         alt="Logo of {{ $about->title }}"
                         class="img-fluid rounded-3 shadow"
                         style="max-width: 150px; max-height: 150px; object-fit: contain;">
                </div>
            @endif

            <div class="col-12 col-sm-7">
                <div class="p-3 bg-light rounded-3 shadow-sm border">
                    <p class="fs-6 text-secondary" style="line-height: 1.7; white-space: pre-line;">
                        {!! nl2br(e($about->description)) !!}
                    </p>
                </div>
            </div>
        </div>
    @else
        {{-- Empty State --}}
        <div class="text-center py-4">
            <i class="fas fa-info-circle fa-2x text-muted mb-3"></i>
            <p class="fs-6 text-muted fst-italic">No "About Us" content available yet.</p>
        </div>
    @endif
</div>

{{-- Custom Styles --}}
<style>
    body {
        background-color: #fafbfc;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    @media (max-width: 576px) {
        h2.fw-bold {
            font-size: 1.5rem;
        }
    }
</style>
@endsection
