<!-- ✅ TOP NAVIGATION BAR -->
<nav class="sb-topnav custom-navbar navbar navbar-expand">

    <!-- 🔹 Brand -->
    <a class="navbar-brand ps-3 fw-bold" href="{{ url('/admin/dashboard') }}">
        <i class="fas fa-shopping-cart me-2"></i>E-Commerce
    </a>

    <!-- 🔹 Sidebar Toggle Button -->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-3 text-white" id="sidebarToggle" aria-label="Toggle sidebar">
        <i class="fas fa-bars"></i>
    </button>

    <ul class="navbar-nav ms-auto me-3 align-items-center">
        <!-- 🔍 Dynamic Search Form -->
        <li class="nav-item me-3 d-none d-md-flex">
            <form method="GET"
                  action="{{ request()->is('admin/categories') ? url('/admin/categories') : url('/admin/brands') }}"
                  role="search"
                  aria-label="Search form"
                  class="d-flex">
                <div class="input-group shadow-sm rounded">
                    <input name="search"
                           class="form-control border-0"
                           type="search"
                           value="{{ request('search') }}"
                           placeholder="Search categories or brands..."
                           aria-label="Search input" />
                    <button class="btn btn-warning px-3" type="submit" aria-label="Submit search">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </li>

        <!-- 🔹 User Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fw-semibold text-white d-flex align-items-center" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                <i class="fas fa-user-circle fa-lg me-2"></i> {{ Auth::user()->name ?? 'Guest' }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm rounded-3" aria-labelledby="navbarDropdown">
              
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger" aria-label="Log out">
                            Log Out
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>

</nav>

<!-- ✅ CUSTOM CSS FOR NAVBAR -->
<style>
.custom-navbar {
    background: linear-gradient(90deg, #0066cc, #00aaff);
    padding: 0.65rem 1.25rem;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12);
    font-size: 0.95rem;
    user-select: none;
}

.custom-navbar .navbar-brand {
    color: #fff;
    font-size: 1.25rem;
    letter-spacing: 0.7px;
    display: flex;
    align-items: center;
    transition: color 0.3s ease;
}

.custom-navbar .navbar-brand:hover {
    color: #ffc107;
}

.custom-navbar .btn-warning {
    background-color: #ffc107;
    border: none;
    border-radius: 0 0.4rem 0.4rem 0;
    color: #222;
    font-weight: 600;
    transition: background-color 0.25s ease;
}

.custom-navbar .btn-warning:hover {
    background-color: #e0a800;
}

.custom-navbar .nav-link {
    color: #fff !important;
    font-weight: 600;
    transition: color 0.3s ease;
}

.custom-navbar .nav-link:hover,
.custom-navbar .nav-link:focus {
    color: #ffc107 !important;
    text-decoration: none;
}

.custom-navbar .dropdown-menu {
    background-color: #fff;
    border-radius: 0.5rem;
    box-shadow: 0 6px 15px rgba(0,0,0,0.12);
    font-weight: 500;
    min-width: 190px;
}

.custom-navbar .dropdown-item {
    font-weight: 500;
    transition: background-color 0.2s ease;
}

.custom-navbar .dropdown-item:hover,
.custom-navbar .dropdown-item:focus {
    background-color: #f8f9fa;
    color: #0066cc;
}

.custom-navbar .dropdown-divider {
    border-color: #dee2e6;
    margin: 0.25rem 0;
}

.input-group .form-control {
    font-size: 0.9rem;
    border-radius: 0.4rem 0 0 0.4rem;
    border: none;
    box-shadow: none;
}

.input-group {
    max-width: 280px;
}

.input-group .btn {
    padding: 0.4rem 1rem;
    border-radius: 0 0.4rem 0.4rem 0;
}

@media (max-width: 768px) {
    .custom-navbar .form-inline {
        display: none !important;
    }
}
</style>
