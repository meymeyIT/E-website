@extends('layouts.admin')

@section('content')

<style>
    /* Mirror-like background gradient with subtle shine */
    body, html {
        height: 100%;
        margin: 0;
        background: linear-gradient(135deg, #f0f4ff 0%, #d9e4ff 40%, #b0c4ff 60%, #f0f4ff 100%);
        overflow-x: hidden;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Overlay subtle shine (mirror reflection effect) */
    body::before {
        content: "";
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        pointer-events: none;
        background:
            linear-gradient(120deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 60%),
            linear-gradient(60deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
        mix-blend-mode: screen;
        z-index: -1;
    }

    /* Center card vertically and horizontally */
    .mirror-container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2rem 1rem;
    }

    /* Card styling */
    .card {
        max-width: 380px;
        width: 100%;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        border-radius: 12px;
        background: rgba(255 255 255 / 0.95);
        backdrop-filter: saturate(180%) blur(15px);
        -webkit-backdrop-filter: saturate(180%) blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        color: #222;
    }

    .card-header {
        background-image: linear-gradient(135deg, #4169e1, #1e3aa7);
        color: white;
        padding: 0.5rem 1rem;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        font-size: 0.9rem;
        letter-spacing: 0.03em;
        font-weight: 600;
        box-shadow: inset 0 -3px 8px rgba(0,0,0,0.3);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-light {
        font-size: 0.75rem;
        padding: 0.3rem 0.8rem;
        font-weight: 600;
        border-radius: 0.3rem;
        background-color: #f8f9fa;
        color: #1e3aa7;
        border: 1px solid #a3b0ff;
        transition: all 0.3s ease;
    }
    .btn-light:hover {
        background-color: #d0dbff;
        color: #0d1e62;
        box-shadow: 0 4px 10px rgba(13, 30, 98, 0.3);
    }

    .card-body {
        padding: 1rem 1rem 1.5rem 1rem;
        font-size: 0.85rem;
        line-height: 1.4;
        color: #222;
    }

    .details-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.85rem;
    }
    .details-row strong {
        color: #555;
        letter-spacing: 0.02em;
        font-weight: 600;
    }

    .description-box {
        background: #f5f8ff;
        border-radius: 6px;
        padding: 0.5rem 0.75rem;
        font-size: 0.8rem;
        color: #444;
        min-height: 50px;
        white-space: pre-wrap;
        margin-top: 0.3rem;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.07);
    }

    .image-wrapper {
        text-align: center;
        margin-bottom: 1.25rem;
    }
    .image-wrapper img {
        max-width: 140px;
        border-radius: 8px;
        box-shadow: 0 6px 12px rgba(0,0,0,0.12);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }
    .image-wrapper img:hover {
        transform: scale(1.06);
        box-shadow: 0 12px 20px rgba(0,0,0,0.18);
    }
</style>

<div class="mirror-container">
    <div class="card">
        <div class="card-header">
            <span>Category Details</span>
            <a href="{{ url('/admin/categories') }}" class="btn btn-light btn-hover">Back</a>
        </div>
        <div class="card-body">
            <div class="details-row"><strong>ID:</strong> <span>{{ $category->id }}</span></div>
            <div class="details-row"><strong>Name:</strong> <span>{{ $category->name }}</span></div>

            <div>
                <strong>Description:</strong>
                <div class="description-box">{{ $category->description }}</div>
            </div>

            <div class="details-row"><strong>Status:</strong> <span>{{ $category->status ? 'Show' : 'Hide' }}</span></div>
            <div class="details-row"><strong>Popular:</strong> <span>{{ $category->popular ? 'Yes' : 'No' }}</span></div>

            @if($category->image)
            <div class="image-wrapper">
                <strong>Image:</strong><br>
                <img src="{{ asset($category->image) }}" alt="Category Image">
            </div>
            @endif

            <div class="details-row"><strong>Meta Title:</strong> <span>{{ $category->meta_title }}</span></div>
            <div class="details-row"><strong>Meta Description:</strong> <span>{{ $category->meta_description }}</span></div>
            <div class="details-row"><strong>Meta Keyword:</strong> <span>{{ $category->meta_keyword }}</span></div>
        </div>
    </div>
</div>

@endsection
