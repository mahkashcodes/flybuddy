@extends('layouts.app')

@section('title', 'Fly Buddy - Travel Simplified')

@section('content')
<!-- Hero Section -->
<div class="hero-section min-vh-100 d-flex align-items-center position-relative overflow-hidden">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-3 fw-bold mb-4">
                    Travel Smart.<br>
                    <span class="text-primary">Fly Buddy</span>
                </h1>
                <p class="lead text-muted mb-5">
                    Your gateway to unforgettable experiences. Simple, seamless, and sophisticated travel planning.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('destinations.index') }}" class="btn btn-primary btn-lg px-4 py-3">
                        <i class="fas fa-globe me-2"></i> Explore Destinations
                    </a>
                    <a href="{{ route('packages.index') }}" class="btn btn-outline-primary btn-lg px-4 py-3">
                        <i class="fas fa-gem me-2"></i> View Packages
                    </a>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="floating-illustration">
                    <div class="position-relative">
                        <div class="circle-1"></div>
                        <div class="circle-2"></div>
                        <div class="circle-3"></div>
                        <div class="main-image">
                            <img src="https://images.pexels.com/photos/346885/pexels-photo-346885.jpeg" 
                                 class="img-fluid rounded-4 shadow-lg" 
                                 alt="Travel" 
                                 style="max-height: 500px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Simple CTA -->
<div class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="display-5 fw-bold mb-4">Ready to Explore?</h2>
                <p class="lead text-muted mb-5">
                    Discover curated destinations and packages tailored for the modern traveler.
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('destinations.index') }}" class="btn btn-primary px-5">
                        Browse Destinations
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-primary px-5">
                        Get in Touch
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Simple Footer Banner -->
<div class="py-4 bg-dark text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <p class="mb-0">✈️ Start your journey with Fly Buddy today.</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('packages.index') }}" class="btn btn-light btn-sm">
                    View All Packages
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.hero-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.floating-illustration {
    position: relative;
    animation: float 6s ease-in-out infinite;
}

.circle-1, .circle-2, .circle-3 {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
}

.circle-1 {
    width: 120px;
    height: 120px;
    top: -20px;
    right: -20px;
}

.circle-2 {
    width: 80px;
    height: 80px;
    bottom: 30px;
    left: -40px;
}

.circle-3 {
    width: 60px;
    height: 60px;
    bottom: -20px;
    right: 40px;
}

.main-image {
    position: relative;
    z-index: 2;
    border: 8px solid white;
    border-radius: 20px;
    overflow: hidden;
}

@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
    100% { transform: translateY(0px); }
}
</style>
@endsection