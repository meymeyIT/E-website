<div class="sticky-top">
    <div class="top-navbar py-1 bg-primary text-white small">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <ul class="list-group list-group-horizontal border-0 bg-transparent mb-0">
                        <li class="border-0 px-2 bg-transparent">
                            <a href="tel:09xxx234" class="text-white text-decoration-none">
                                <i class="fa fa-whatsapp me-1"></i> 09xxx234
                            </a>
                        </li>
                        <li class="border-0 px-2 bg-transparent">
                            <a href="mailto:l@gmail.com" class="text-white text-decoration-none">
                                <i class="fa fa-envelope-o me-1"></i> l@gmail.com
                            </a>
                        </li>
                        <li class="border-0 px-2 bg-transparent">
                            <a href="tel:097765453" class="text-white text-decoration-none">
                                <i class="fa fa-phone me-1"></i> 097765453
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 text-end">
                    <span class="me-2">Follow Us:</span>
                    <a href="https://web.facebook.com/profile.php?id=100081051023949" target="_blank" class="text-white me-2 fs-6 hover-opacity">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://twitter.com" target="_blank" class="text-white me-2 fs-6 hover-opacity">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://youtube.com" target="_blank" class="text-white fs-6 hover-opacity">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg sticky-top shadow bg-white cute-navbar">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/npic1.jpg') }}" alt="Logo" style="width: 50px; height: 50px;" class="rounded-circle shadow-sm me-2">
            E-Commerce
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link active fw-semibold" href="{{ url('/') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="{{ url('categories') }}">Shop by Category</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="{{ url('products') }}">Products</a>
                </li>

                {{-- Cart link with badge --}}
                <li class="nav-item">
                    <a href="{{ route('cart.index') }}" class="nav-link fw-semibold position-relative">
                        <i class="fa fa-shopping-cart me-1"></i> Cart
                        @if(isset($cartCount) && $cartCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $cartCount }}
                                <span class="visually-hidden">items in cart</span>
                            </span>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="{{ url('about-us') }}">About Us</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="{{ url('contact-us') }}">Contact Us</a>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item fw-semibold" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); this.closest('form').submit();">
                                        Log Out
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-btn dropdown-toggle fw-semibold" href="#" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-sign-in me-1 fs-6"></i> Login / Sign Up
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                            @if (Route::has('register'))
                                <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                            @endif
                        </ul>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<style>
    /* Hover opacity effect on social icons */
    .hover-opacity:hover {
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }
</style>
