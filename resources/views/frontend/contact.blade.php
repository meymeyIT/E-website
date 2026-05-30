@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- System Alerts Messages --}}
            @foreach (['success', 'error', 'warning', 'info'] as $msg)
                @if(session()->has($msg))
                    <div class="alert alert-{{ $msg === 'error' ? 'danger' : $msg }} alert-dismissible fade show" role="alert">
                        {{ session($msg) }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            @endforeach

            <div class="row g-4">
                <!-- 📬 Contact Form -->
                <div class="col-md-7">
                    <div class="card shadow-lg border-0 rounded-4 h-100">
                        <div class="card-body p-5">
                            <h2 class="mb-4 text-primary fw-bold text-center">
                                <i class="bi bi-envelope-fill me-2"></i>Contact Us
                            </h2>

                            <form method="POST" action="{{ route('contact.send') }}" novalidate>
                                @csrf

                                <div class="form-floating mb-3">
                                    <input id="name" name="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="Your Name" value="{{ old('name') }}" required>
                                    <label for="name"><i class="bi bi-person-fill me-2"></i>Name *</label>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-floating mb-3">
                                    <input id="email" name="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="Your Email" value="{{ old('email') }}" required>
                                    <label for="email"><i class="bi bi-envelope-at-fill me-2"></i>Email *</label>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-floating mb-3">
                                    <input id="subject" name="subject" type="text"
                                           class="form-control @error('subject') is-invalid @enderror"
                                           placeholder="Subject" value="{{ old('subject') }}" required>
                                    <label for="subject"><i class="bi bi-chat-text-fill me-2"></i>Subject *</label>
                                    @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-floating mb-4">
                                    <textarea id="message" name="message"
                                              class="form-control @error('message') is-invalid @enderror"
                                              placeholder="Your Message" style="height: 160px;" required>{{ old('message') }}</textarea>
                                    <label for="message"><i class="bi bi-pencil-fill me-2"></i>Message *</label>
                                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm">
                                        <i class="bi bi-send-fill me-1"></i>Send Message
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- 📦 Contact Information -->
                <div class="col-md-5">
                    <div class="card shadow-lg border-0 rounded-4 bg-light h-100">
                        <div class="card-body p-4">
                            <h4 class="mb-4 text-primary fw-bold">
                                <i class="bi bi-info-circle-fill me-2"></i>Contact Information
                            </h4>

                            <ul class="list-unstyled fs-6 text-secondary">
                                <li class="mb-3 d-flex align-items-start">
                                    <i class="bi bi-geo-alt-fill text-danger me-3 fs-5"></i>
                                    <address class="mb-0">
                                        <strong>Address:</strong><br>
                                        #123, Phnom Penh, Cambodia
                                    </address>
                                </li>
                                <li class="mb-3 d-flex align-items-start">
                                    <i class="bi bi-telephone-fill text-success me-3 fs-5"></i>
                                    <div>
                                        <strong>Phone:</strong><br>
                                        <a href="tel:+855976545291" class="text-decoration-none text-secondary">+855 976 545 291</a>
                                    </div>
                                </li>
                                <li class="mb-3 d-flex align-items-start">
                                    <i class="bi bi-envelope-fill text-primary me-3 fs-5"></i>
                                    <div>
                                        <strong>Email:</strong><br>
                                        <a href="mailto:smey12@gmail.com" class="text-decoration-none text-secondary">smey12@gmail.com</a>
                                    </div>
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="bi bi-clock-fill text-warning me-3 fs-5"></i>
                                    <div>
                                        <strong>Working Hours:</strong><br>
                                        Monday - Sunday, 6AM - 6PM
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 🗺️ Google Map (Full Width) -->
            <div class="mt-5">
                <h5 class="mb-3 text-secondary"><i class="bi bi-map-fill me-2"></i>Find Us on the Map</h5>
                <div class="ratio ratio-16x9 rounded-3 overflow-hidden shadow-sm">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.979884826947!2d104.9056045!3d11.567179!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951317e164e0b%3A0x472eeb71f53c6cf2!2sGOD%20COMPUTER%20098588598!5e0!3m2!1sen!2skh!4v1722091234567!5m2!1sen!2skh"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Company Location on Google Maps">
                    </iframe>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
