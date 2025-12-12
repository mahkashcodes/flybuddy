@extends('layouts.app')

@section('title', 'Admin Dashboard - Fly Buddy')

@section('content')
<div class="container-fluid py-4 mt-5">
    <!-- Success Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        ✅ {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        ❌ {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">🛠️ Admin Dashboard</h1>
        <div>
            <span class="badge bg-info">Welcome, {{ auth()->user()->name }}</span>
            <span class="badge bg-warning ms-1">Admin</span>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Destinations</h6>
                            <h2 class="mb-0">{{ $destinationCount }}</h2>
                        </div>
                        <i class="fas fa-globe fa-3x opacity-50"></i>
                    </div>
                    <a href="{{ route('destinations.index') }}" class="text-white small">View All →</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Packages</h6>
                            <h2 class="mb-0">{{ $packageCount }}</h2>
                        </div>
                        <i class="fas fa-suitcase fa-3x opacity-50"></i>
                    </div>
                    <a href="{{ route('packages.index') }}" class="text-white small">View All →</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Featured Destinations</h6>
                            <h2 class="mb-0">{{ $featuredDestinationCount }}</h2>
                        </div>
                        <i class="fas fa-star fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Users</h6>
                            <h2 class="mb-0">{{ $usersCount }}</h2>
                        </div>
                        <i class="fas fa-users fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">🚀 Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('destinations.create') }}" class="btn btn-primary w-100">
                                <i class="fas fa-plus me-2"></i> Add Destination
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('packages.create') }}" class="btn btn-success w-100">
                                <i class="fas fa-plus me-2"></i> Add Package
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('destinations.index') }}" class="btn btn-info w-100">
                                <i class="fas fa-list me-2"></i> Manage Destinations
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('packages.index') }}" class="btn btn-warning w-100">
                                <i class="fas fa-list me-2"></i> Manage Packages
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Activity -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">📍 Recent Destinations</h5>
                </div>
                <div class="card-body">
                    @if($latestDestinations->count() > 0)
                    <div class="list-group">
                        @foreach($latestDestinations as $destination)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $destination->name }}</strong>
                                    <div class="text-muted small">
                                        {{ $destination->country }} • 
                                        ${{ number_format($destination->starting_price) }}
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('destinations.edit', $destination->id) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-muted">No destinations added yet.</p>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">🎯 Recent Packages</h5>
                </div>
                <div class="card-body">
                    @if($latestPackages->count() > 0)
                    <div class="list-group">
                        @foreach($latestPackages as $package)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $package->name }}</strong>
                                    <div class="text-muted small">
                                        {{ $package->destination->name }} • 
                                        ${{ number_format($package->price, 2) }} • 
                                        {{ $package->duration_days }} days
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('packages.edit', $package->id) }}" 
                                       class="btn btn-sm btn-outline-success">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-muted">No packages added yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection