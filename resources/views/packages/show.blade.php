@extends('layouts.app')

@section('title', $package->name . ' - Fly Buddy')

@section('content')
<div class="container-fluid px-0">
    <div class="row g-0">
        <!-- Left: Image Sidebar - Fixed Width -->
        <div class="col-lg-5 position-sticky top-0 vh-100 p-0" style="z-index: 1;">
            <div class="h-100 position-relative">
                <img src="{{ $package->image_url ?: $package->destination->featured_image }}" 
                     class="img-fluid h-100 w-100"
                     alt="{{ $package->name }}"
                     style="object-fit: cover; object-position: center;"
                     onerror="this.src='{{ $package->destination->featured_image }}'">
                
                <!-- Overlay Gradient -->
                <div class="position-absolute top-0 start-0 w-100 h-100" 
                     style="background: linear-gradient(to bottom, transparent 60%, rgba(0,0,0,0.7) 100%);"></div>
                
                <!-- Back Button -->
                <div class="position-absolute top-3 start-3">
                    <a href="{{ route('packages.index') }}" class="btn btn-light btn-sm rounded-pill shadow-sm">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                </div>
                
                <!-- Package Title on Image -->
                <div class="position-absolute bottom-0 start-0 p-4 text-white">
                    <h1 class="display-6 fw-bold mb-2">{{ $package->name }}</h1>
                    <div class="d-flex align-items-center flex-wrap">
                        <a href="{{ route('destinations.show', $package->destination_id) }}" 
                           class="badge bg-light text-dark me-2 mb-1 text-decoration-none">
                            <i class="fas fa-map-marker-alt me-1"></i> {{ $package->destination->name }}
                        </a>
                        <span class="badge bg-light text-dark me-2 mb-1">
                            <i class="fas fa-calendar me-1"></i> {{ $package->duration_days }} days
                        </span>
                        <span class="badge bg-light text-dark mb-1">
                            <i class="fas fa-users me-1"></i> Max {{ $package->max_people }} people
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right: Content Panel - Scrollable -->
        <div class="col-lg-7">
            <div class="min-vh-100 p-4 p-lg-5">
                <!-- Price Card -->
                <div class="card border-0 shadow-sm mb-5 bg-primary text-white">
                    <div class="card-body text-center py-4">
                        <h6 class="opacity-75 mb-2">Package Price</h6>
                        <h2 class="display-4 fw-bold mb-1">${{ number_format($package->price, 2) }}</h2>
                        <small class="opacity-75">Per person • All inclusive</small>
                    </div>
                </div>
                
                <!-- Description -->
                <div class="mb-5">
                    <h4 class="fw-bold mb-3">Package Overview</h4>
                    <p class="lead text-muted">{{ $package->description }}</p>
                </div>
                
                <!-- Inclusions & Exclusions -->
                <div class="row mb-5">
                    <div class="col-md-6 mb-4">
                        <div class="card border-success border-2 h-100">
                            <div class="card-header bg-success text-white border-0">
                                <h5 class="mb-0"><i class="fas fa-check-circle me-2"></i> What's Included</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled mb-0">
                                    @foreach(json_decode($package->inclusions ?? '[]') as $inclusion)
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i> {{ $inclusion }}
                                    </li>
                                    @endforeach
                                    @if(empty(json_decode($package->inclusions ?? '[]')))
                                    <li class="text-muted">No inclusions specified</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card border-danger border-2 h-100">
                            <div class="card-header bg-danger text-white border-0">
                                <h5 class="mb-0"><i class="fas fa-times-circle me-2"></i> What's Not Included</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled mb-0">
                                    @foreach(json_decode($package->exclusions ?? '[]') as $exclusion)
                                    <li class="mb-2">
                                        <i class="fas fa-times text-danger me-2"></i> {{ $exclusion }}
                                    </li>
                                    @endforeach
                                    @if(empty(json_decode($package->exclusions ?? '[]')))
                                    <li class="text-muted">No exclusions specified</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="d-grid gap-3 mb-5">
                    <a href="{{ route('contact') }}?package={{ $package->id }}&package_name={{ urlencode($package->name) }}" 
                       class="btn btn-primary btn-lg py-3">
                        <i class="fas fa-envelope me-2"></i> Contact Us About This Package
                    </a>
                    
                    <a href="{{ route('destinations.show', $package->destination_id) }}" 
                       class="btn btn-outline-primary btn-lg py-3">
                        <i class="fas fa-globe me-2"></i> View Destination Details
                    </a>
                </div>
                
                <!-- Package Details -->
                <div class="card border-0 shadow-sm mb-5">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="fw-bold mb-0"><i class="fas fa-info-circle me-2 text-primary"></i> Package Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Package ID</small>
                                <strong>#{{ str_pad($package->id, 6, '0', STR_PAD_LEFT) }}</strong>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Duration</small>
                                <strong>{{ $package->duration_days }} days / {{ $package->duration_days - 1 }} nights</strong>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Group Size</small>
                                <strong>Up to {{ $package->max_people }} people</strong>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Status</small>
                                <span class="badge bg-{{ $package->is_active ? 'success' : 'danger' }}">
                                    {{ $package->is_active ? 'Available' : 'Unavailable' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Admin Actions -->
                @auth
                <div class="border-top pt-4">
                    <h5 class="fw-bold mb-3">Admin Actions</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('packages.edit', $package->id) }}" 
                           class="btn btn-outline-warning w-50">
                            <i class="fas fa-edit me-2"></i> Edit
                        </a>
                        <form action="{{ route('packages.destroy', $package->id) }}" method="POST" class="w-50">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100"
                                    onclick="return confirm('Delete this package?')">
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