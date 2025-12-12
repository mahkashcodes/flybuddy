@extends('layouts.app')

@section('title', $destination->name . ' - Fly Buddy')

@section('content')
<div class="container-fluid px-0 mt-4">
    <div class="row g-0">
        <!-- Left: Stretched Image -->
        <div class="col-lg-8 position-relative" style="min-height: 100vh;">
            <div class="position-fixed top-0 start-0 h-100 w-lg-50" style="z-index: -1;">
                <img src="{{ $destination->featured_image ?: 'https://images.pexels.com/photos/338515/pexels-photo-338515.jpeg' }}" 
                     class="img-fluid h-100 w-100"
                     alt="{{ $destination->name }}"
                     style="object-fit: cover; object-position: center;"
                     onerror="this.src='https://images.pexels.com/photos/338515/pexels-photo-338515.jpeg'">
                <div class="position-absolute top-0 start-0 w-100 h-100" 
                     style="background: linear-gradient(to right, rgba(0,0,0,0.3), transparent);"></div>
            </div>
            
            <!-- Back Button -->
            <div class="position-absolute top-4 start-4">
                <a href="{{ route('destinations.index') }}" class="btn btn-light btn-sm rounded-pill shadow">
                    <i class="fas fa-arrow-left me-2"></i> Back to Destinations
                </a>
            </div>
        </div>
        
        <!-- Right: Content Panel -->
        <div class="col-lg-4 offset-lg-8">
            <div class="bg-white min-vh-100 p-5 shadow-lg">
                <!-- Destination Header -->
                <div class="mb-5">
                    <h1 class="display-5 fw-bold mb-3">{{ $destination->name }}</h1>
                    
                    <div class="d-flex align-items-center mb-4">
                        <span class="badge bg-primary bg-gradient me-2 py-2 px-3">
                            <i class="fas fa-globe me-1"></i> {{ $destination->continent }}
                        </span>
                        <span class="badge bg-info bg-gradient me-2 py-2 px-3">
                            <i class="fas fa-map-marker-alt me-1"></i> {{ $destination->country }}
                        </span>
                        @if($destination->is_featured)
                        <span class="badge bg-warning bg-gradient py-2 px-3">
                            <i class="fas fa-star me-1"></i> Featured
                        </span>
                        @endif
                    </div>
                    
                    <!-- Price -->
                    <div class="bg-light rounded-3 p-4 mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Starting from</h6>
                                <h2 class="text-primary fw-bold mb-0">${{ number_format($destination->starting_price, 0) }}</h2>
                                <small class="text-muted">Per person</small>
                            </div>
                            <div class="text-end">
                                @if($destination->is_active)
                                <span class="badge bg-success py-2 px-3">Available</span>
                                @else
                                <span class="badge bg-danger py-2 px-3">Unavailable</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Destination Description -->
                <div class="mb-5">
                    <h4 class="fw-bold mb-3">✨ About This Destination</h4>
                    <p class="text-muted lead">{{ $destination->description }}</p>
                </div>
                
                <!-- Travel Info -->
                <div class="row mb-5">
                    <div class="col-12 mb-4">
                        <div class="card border-info border-2">
                            <div class="card-header bg-info bg-gradient text-white">
                                <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i> Best Time to Visit</h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-0">{{ $destination->best_time_to_visit }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="d-grid gap-3">
                    <!-- View Packages Button -->
                    <a href="{{ route('packages.index') }}?destination={{ $destination->id }}" 
                       class="btn btn-primary btn-lg py-3">
                        <i class="fas fa-suitcase me-2"></i> View Travel Packages
                    </a>
                    
                    <!-- Contact Button -->
                    <a href="{{ route('contact') }}?destination={{ $destination->id }}&destination_name={{ urlencode($destination->name) }}" 
                       class="btn btn-outline-primary btn-lg py-3">
                        <i class="fas fa-envelope me-2"></i> Contact Us About This Destination
                    </a>
                    
                    <!-- Quick Actions -->
                    <div class="d-flex gap-2">
                        <a href="{{ route('packages.index') }}" 
                           class="btn btn-outline-info w-100">
                            <i class="fas fa-suitcase me-2"></i> All Packages
                        </a>
                        <button class="btn btn-outline-secondary w-100" onclick="window.print()">
                            <i class="fas fa-print me-2"></i> Print Details
                        </button>
                    </div>
                </div>
                
                <!-- Destination Details -->
                <div class="mt-5 pt-4 border-top">
                    <h5 class="fw-bold mb-3">📋 Destination Details</h5>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <small class="text-muted d-block">Destination ID</small>
                            <strong>#{{ str_pad($destination->id, 6, '0', STR_PAD_LEFT) }}</strong>
                        </div>
                        <div class="col-6 mb-3">
                            <small class="text-muted d-block">Continent</small>
                            <strong>{{ $destination->continent }}</strong>
                        </div>
                        <div class="col-6 mb-3">
                            <small class="text-muted d-block">Country</small>
                            <strong>{{ $destination->country }}</strong>
                        </div>
                        <div class="col-6 mb-3">
                            <small class="text-muted d-block">Status</small>
                            <strong>{{ $destination->is_active ? 'Active' : 'Inactive' }}</strong>
                        </div>
                    </div>
                </div>
                
                <!-- Admin Actions -->
                @auth
                <div class="mt-5 pt-4 border-top">
                    <h5 class="fw-bold mb-3">🔧 Admin Actions</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('destinations.edit', $destination->id) }}" 
                           class="btn btn-warning w-100">
                            <i class="fas fa-edit me-2"></i> Edit Destination
                        </a>
                        <form action="{{ route('destinations.destroy', $destination->id) }}" method="POST" class="w-100">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100"
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
/* Ensure image stretches full height */
body, html {
    overflow-x: hidden;
}

/* Smooth transitions */
.position-fixed {
    transition: all 0.3s ease;
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .position-fixed {
        position: relative !important;
        height: 50vh !important;
        width: 100% !important;
    }
    .col-lg-4.offset-lg-8 {
        margin-left: 0 !important;
    }
}
</style>
@endsection