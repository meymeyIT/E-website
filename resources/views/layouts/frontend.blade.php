<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />

    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous" />

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/styles.css') }}" />

    <style>
        body {
            font-family: 'Battambang', 'Roboto', sans-serif;
            background-color: #f0f2f5;
        }

        .hover-bg-light:hover {
            background-color: #f8f9fa;
            transition: background-color 0.3s ease;
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Navbar --}}
    @include('layouts.partails.navbar')

    {{-- Main Content --}}
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Panzoom for image zoom functionality -->
    <script src="https://cdn.jsdelivr.net/npm/@panzoom/panzoom@9.4.0/dist/panzoom.min.js"></script>

    @stack('scripts')
</body>
</html>
