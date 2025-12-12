@extends('layouts.app')

@section('title', 'Travel Packages - Fly Buddy')

@section('content')
<div class="container py-5">
    <h1 class="display-4 fw-bold text-center mb-5">✈️ Travel Packages</h1>
    
    <div class="row">
        @foreach($packages as $package)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <img src="{{ $package->image_url ?: $package->destination->featured_image }}" 
                     class="card-img-top" alt="{{ $package->name }}"
                     style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $package->name }}</h5>
                    <p class="card-text">{{ Str::limit($package->description, 100) }}</p>
                    
                    <div class="mb-3">
                        <span class="badge bg-primary">{{ $package->destination->name }}</span>
                        <span class="badge bg-info ms-1">{{ $package->duration_days }} days</span>
                        <span class="badge bg-success ms-1">Max: {{ $package->max_people }} people</span>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="text-primary mb-0">${{ number_format($package->price, 2) }}</h4>
                       <a href="/packages/{{ $package->id }}" class="btn btn-primary">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-4">
        {{ $packages->links() }}
    </div>
</div>
@endsection