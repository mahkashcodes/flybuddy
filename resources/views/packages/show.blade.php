@extends('layouts.app')

@section('title', $package->name . ' - Fly Buddy')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <img src="{{ $package->image_url ?: $package->destination->featured_image }}" 
                 class="img-fluid rounded shadow" alt="{{ $package->name }}"
                 style="height: 400px; object-fit: cover; width: 100%;">
        </div>
        <div class="col-md-4">
            <h1 class="display-5 fw-bold">{{ $package->name }}</h1>
            
            <div class="mb-3">
                <a href="{{ route('destinations.show', $package->destination_id) }}" 
                   class="text-decoration-none">
                    <span class="badge bg-primary">{{ $package->destination->name }}</span>
                </a>
                <span class="badge bg-info ms-2">{{ $package->duration_days }} days</span>
                <span class="badge bg-success ms-2">Max: {{ $package->max_people }} people</span>
            </div>
            
            <p class="lead">{{ $package->description }}</p>
            
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Package Details</h5>
                    
                    <h3 class="text-primary">${{ number_format($package->price, 2) }}</h3>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h6>Inclusions:</h6>
                            <ul>
                                @foreach(json_decode($package->inclusions ?? '[]') as $inclusion)
                                    <li>{{ $inclusion }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6>Exclusions:</h6>
                            <ul>
                                @foreach(json_decode($package->exclusions ?? '[]') as $exclusion)
                                    <li>{{ $exclusion }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <button class="btn btn-success btn-lg w-100 mb-3">
                <i class="fas fa-shopping-cart"></i> Book Now
            </button>
            
         <a href="/packages" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left"></i> Back to Packages
            </a>
        </div>
    </div>
</div>
@endsection