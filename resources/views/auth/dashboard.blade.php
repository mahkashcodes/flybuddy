@extends('layouts.app')

@section('title', 'Admin Dashboard - Fly Buddy')

@section('content')
<div class="container-fluid py-4">
    <!-- Dashboard Header -->
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 fw-bold">
                <i class="fas fa-tachometer-alt me-2"></i> Admin Dashboard
            </h1>
            <p class="text-muted">Welcome back, {{ Auth::user()->name }}!</p>
        </div>
        <div class="col-auto">
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-white-50">Destinations</h6>
                            <h2 class="mb-0">{{ $destinationsCount ?? 0 }}</h2>
                        </div>
                        <i class="fas fa-globe-americas fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-white-50">Packages</h6>
                            <h2 class="mb-0">{{ $packagesCount ?? 0 }}</h2>
                        </div>
                        <i class="fas fa-suitcase fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-white-50">Users</h6>
                            <h2 class="mb-0">{{ $usersCount ?? 0 }}</h2>
                        </div>
                        <i class="fas fa-users fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-white-50">Bookings</h6>
                            <h2 class="mb-0">0</h2>
                        </div>
                        <i class="fas fa-calendar-check fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-bolt me-2"></i> Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('destinations.create') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-plus me-1"></i> Add Destination
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('packages.create') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-plus me-1"></i> Add Package
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('destinations.index') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-list me-1"></i> Destinations
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('packages.index') }}" class="btn btn-outline-warning w-100">
                                <i class="fas fa-list me-1"></i> Packages
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection