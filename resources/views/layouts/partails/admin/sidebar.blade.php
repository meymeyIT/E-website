<nav class="sb-sidenav accordion custom-sidenav-sm" id="sidenavAccordion" aria-label="Admin Sidebar Navigation">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                href="{{ url('/admin/dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>

            <div class="sb-sidenav-menu-heading">Interface</div>

            <!-- Category -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory"
                aria-expanded="{{ request()->is('admin/categories*') ? 'true' : 'false' }}"
                aria-controls="collapseCategory">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Category
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse {{ request()->is('admin/categories*') ? 'show' : '' }}" id="collapseCategory"
                data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav flex-column">
                    <a class="nav-link {{ request()->is('admin/categories/create') ? 'active' : '' }}"
                        href="{{ url('/admin/categories/create') }}">Create Category</a>
                    <a class="nav-link {{ request()->is('admin/categories') && !request()->is('admin/categories/create') ? 'active' : '' }}"
                        href="{{ url('/admin/categories') }}">View Category</a>
                </nav>
            </div>

            <!-- Brands -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseBrand"
                aria-expanded="{{ request()->is('admin/brands*') ? 'true' : 'false' }}"
                aria-controls="collapseBrand">
                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                Brands
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse {{ request()->is('admin/brands*') ? 'show' : '' }}" id="collapseBrand"
                data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav flex-column">
                    <a class="nav-link {{ request()->is('admin/brands/create') ? 'active' : '' }}"
                        href="{{ url('admin/brands/create') }}">Create Brand</a>
                    <a class="nav-link {{ request()->is('admin/brands') && !request()->is('admin/brands/create') ? 'active' : '' }}"
                        href="{{ url('admin/brands') }}">View Brand</a>
                </nav>
            </div>

            <!-- Products -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct"
                aria-expanded="{{ request()->is('admin/products*') ? 'true' : 'false' }}"
                aria-controls="collapseProduct">
                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                Products
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse {{ request()->is('admin/products*') ? 'show' : '' }}" id="collapseProduct"
                data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav flex-column">
                    <a class="nav-link {{ request()->is('admin/products/create') ? 'active' : '' }}"
                        href="{{ url('/admin/products/create') }}">Create Product</a>
                    <a class="nav-link {{ request()->is('admin/products') && !request()->is('admin/products/create') ? 'active' : '' }}"
                        href="{{ url('/admin/products') }}">View Product</a>
                </nav>
            </div>

            <!-- Orders -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseOrders"
                aria-expanded="{{ request()->is('admin/orders*') ? 'true' : 'false' }}"
                aria-controls="collapseOrders">
                <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                Orders
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse {{ request()->is('admin/orders*') ? 'show' : '' }}" id="collapseOrders"
                data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav flex-column">
                    <a class="nav-link {{ request()->is('admin/orders') ? 'active' : '' }}"
                        href="{{ url('/admin/orders') }}">View Orders</a>
                </nav>
            </div>

            <!-- Reports -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReports"
                aria-expanded="{{ request()->is('admin/reports*') ? 'true' : 'false' }}"
                aria-controls="collapseReports">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                Reports
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse {{ request()->is('admin/reports*') ? 'show' : '' }}" id="collapseReports"
                data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav flex-column">
                    <a class="nav-link {{ request()->is('admin/reports/sales') ? 'active' : '' }}"
                        href="{{ route('admin.reports.sales') }}">Sales Reports</a>
                </nav>
            </div>
        </div>
    </div>
</nav>

<style>
.custom-sidenav-sm {
    background-color: #002b55;
    color: #ffffff;
    height: 100vh;
    padding-top: 0.75rem;
    font-family: 'Segoe UI', sans-serif;
    font-size: 0.85rem;
}

.custom-sidenav-sm .sb-sidenav-menu-heading {
    font-size: 0.65rem;
    text-transform: uppercase;
    color: #ffcc00;
    padding: 0.5rem 1.2rem 0.25rem;
}

.custom-sidenav-sm .nav-link {
    color: #ffffff;
    padding: 0.4rem 1.25rem;
    font-weight: 500;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 0.65rem;
    border-left: 3px solid transparent;
}

.custom-sidenav-sm .nav-link:hover,
.custom-sidenav-sm .nav-link:focus {
    background-color: #004080;
    color: #ffcc00;
    border-left-color: #ffcc00;
}

.custom-sidenav-sm .nav-link.active {
    background-color: #004080;
    font-weight: 600;
    border-left-color: #ffcc00;
    color: #ffcc00;
}

.custom-sidenav-sm .sb-nav-link-icon {
    color: #ffcc00;
    font-size: 1rem;
    width: 1.25rem;
    text-align: center;
}

.custom-sidenav-sm .sb-sidenav-collapse-arrow {
    color: #ffcc00;
    margin-left: auto;
    font-size: 0.85rem;
}

.custom-sidenav-sm .collapse .nav-link {
    padding-left: 2.2rem;
    font-size: 0.8rem;
    font-weight: 400;
    border-left: none;
}

.custom-sidenav-sm .collapse .nav-link:hover {
    background-color: #0059b3;
    color: #ffcc00;
}

.custom-sidenav-sm .collapse.show .nav-link.active {
    font-weight: 600;
    color: #ffcc00;
}

.custom-sidenav-sm::-webkit-scrollbar {
    width: 5px;
}

.custom-sidenav-sm::-webkit-scrollbar-thumb {
    background-color: rgba(255, 204, 0, 0.3);
    border-radius: 4px;
}
</style>
