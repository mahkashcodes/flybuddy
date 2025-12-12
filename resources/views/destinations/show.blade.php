@extends('layouts.app')

@section('title', $destination->name . ' - Fly Buddy')

@section('content')
<div class="container-fluid px-0">
    <div class="row g-0">
        <!-- Left: Image Sidebar - Fixed Width -->
        <div class="col-lg-5 position-sticky top-0 vh-100 p-0" style="z-index: 1;">
            <div class="h-100 position-relative">
                <img src="{{ $destination->featured_image ?: 'https://images.pexels.com/photos/338515/pexels-photo-338515.jpeg' }}" 
                     class="img-fluid h-100 w-100"
                     alt="{{ $destination->name }}"
                     style="object-fit: cover; object-position: center;"
                     onerror="this.src='https://images.pexels.com/photos/338515/pexels-photo-338515.jpeg'">
                
                <!-- Overlay Gradient -->
                <div class="position-absolute top-0 start-0 w-100 h-100" 
                     style="background: linear-gradient(to bottom, transparent 60%, rgba(0,0,0,0.7) 100%);"></div>
                
                <!-- Back Button -->
                <div class="position-absolute top-3 start-3">
                    <a href="{{ route('destinations.index') }}" class="btn btn-light btn-sm rounded-pill shadow-sm">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                </div>
                
                <!-- Destination Title on Image -->
                <div class="position-absolute bottom-0 start-0 p-4 text-white">
                    <h1 class="display-6 fw-bold mb-2">{{ $destination->name }}</h1>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-light text-dark me-2">
                            <i class="fas fa-map-marker-alt me-1"></i> {{ $destination->country }}
                        </span>
                        <span class="badge bg-light text-dark">
                            <i class="fas fa-globe me-1"></i> {{ $destination->continent }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right: Content Panel - Scrollable -->
        <div class="col-lg-7">
            <div class="min-vh-100 p-4 p-lg-5">
                <!-- Quick Stats -->
                <div class="row mb-5">
                    <div class="col-md-6 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center py-4">
                                <h6 class="text-muted mb-2">Starting Price</h6>
                                <h2 class="text-primary fw-bold mb-0">${{ number_format($destination->starting_price, 0) }}</h2>
                                <small class="text-muted">Per person</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center py-4">
                                <h6 class="text-muted mb-2">Best Time to Visit</h6>
                                <p class="mb-0 fw-bold">{{ $destination->best_time_to_visit }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Description -->
                <div class="mb-5">
                    <h4 class="fw-bold mb-3">About {{ $destination->name }}</h4>
                    <p class="lead text-muted">{{ $destination->description }}</p>
                </div>
                
                <!-- Action Buttons -->
                <div class="d-grid gap-3 mb-5">
                    <a href="{{ route('packages.index') }}?destination={{ $destination->id }}" 
                       class="btn btn-primary btn-lg py-3">
                        <i class="fas fa-suitcase me-2"></i> View Travel Packages
                    </a>
                    
                    <a href="{{ route('contact') }}?destination={{ $destination->id }}&destination_name={{ urlencode($destination->name) }}" 
                       class="btn btn-outline-primary btn-lg py-3">
                        <i class="fas fa-envelope me-2"></i> Contact Us About This Destination
                    </a>
                </div>
                
                <!-- Details Card -->
                <div class="card border-0 shadow-sm mb-5">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="fw-bold mb-0"><i class="fas fa-info-circle me-2 text-primary"></i> Destination Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Destination ID</small>
                                <strong>#{{ str_pad($destination->id, 6, '0', STR_PAD_LEFT) }}</strong>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Continent</small>
                                <strong>{{ $destination->continent }}</strong>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Country</small>
                                <strong>{{ $destination->country }}</strong>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Status</small>
                                <span class="badge bg-{{ $destination->is_active ? 'success' : 'danger' }}">
                                    {{ $destination->is_active ? 'Available' : 'Unavailable' }}
                                </span>
                            </div>
                            @if($destination->is_featured)
                            <div class="col-12">
                                <div class="alert alert-warning border-0">
                                    <i class="fas fa-star me-2"></i> This is a featured destination
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Admin Actions -->
                @auth
                <div class="border-top pt-4">
                    <h5 class="fw-bold mb-3">Admin Actions</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('destinations.edit', $destination->id) }}" 
                           class="btn btn-outline-warning w-50">
                            <i class="fas fa-edit me-2"></i> Edit
                        </a>
                        <form action="{{ route('destinations.destroy', $destination->id) }}" method="POST" class="w-50">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100"
                                    onclick="return confirm('Delete this destination?')">
                                <i class="fas fa-trash me-2"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>
</div>

<style>
/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .col-lg-5.position-sticky {
        position: relative !important;
        height: 60vh !important;
    }
    .col-lg-7 {
        padding-top: 2rem !important;
    }
}

/* Custom shadow for cards */
.shadow-sm {
    box-shadow: 0 2px 8px rgba(0,0,0,0.08) !important;
}
</style>
@endsection