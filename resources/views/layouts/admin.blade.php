<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous" />

    <!-- Simple DataTables CSS -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

    <!-- Custom Admin CSS -->
    <link href="{{ asset('assets/admin/css/styles.css') }}" rel="stylesheet" />

    <!-- FontAwesome 6 JS -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Alert Inline Styles -->
    <style>
        .alert {
            padding: 12px 20px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-size: 14px;
        }
        .alert-success { background-color: #d1e7dd; color: #0f5132; }
        .alert-error, .alert-danger { background-color: #f8d7da; color: #842029; }
        .alert-warning { background-color: #fff3cd; color: #664d03; }
        .alert-info { background-color: #cff4fc; color: #055160; }
    </style>
</head>

<body class="sb-nav-fixed">

    {{-- Top Navbar --}}
    @include('layouts.partails.admin.navbar')

    <div id="layoutSidenav">
        {{-- Sidebar --}}
        <div id="layoutSidenav_nav">
            @include('layouts.partails.admin.sidebar')
        </div>

        {{-- Main Content --}}
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 mt-3">

                    {{-- Flash Messages --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning">{{ session('warning') }}</div>
                    @endif
                    @if (session('info'))
                        <div class="alert alert-info">{{ session('info') }}</div>
                    @endif

                    {{-- Page Content --}}
                    @yield('content')
                </div>
            </main>

            {{-- Footer --}}
            @include('layouts.partails.admin.footer')
        </div>
    </div>

    {{-- JS Scripts --}}

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <!-- Simple DataTables JS -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

    <!-- Custom Admin Scripts -->
    <script src="{{ asset('assets/admin/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/admin/js/datatables-simple-demo.js') }}"></script>

    @stack('scripts') {{-- Optional additional scripts --}}
</body>
</html>
