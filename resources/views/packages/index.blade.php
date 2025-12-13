@extends('layouts.app')

@section('title', 'Travel Packages - Fly Buddy')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold mb-0">✈️ Travel Packages</h1>
        @auth
        <a href="{{ route('packages.create') }}" class="btn btn-sm btn-success">
            <i class="fas fa-plus me-1"></i> Add Package
        </a>
        @endauth
    </div>

    <div class="row gy-4">
        @foreach($packages as $package)
        <div class="col-sm-6 col-md-4">
            <div class="card h-100 shadow-sm">
                <div style="height:200px; overflow:hidden; background:#f6f6f6;">
                    <img src="{{ $package->image_url ?: $package->destination->featured_image }}" 
                         alt="{{ $package->name }}" 
                         class="w-100 h-100" 
                         style="object-fit:cover; display:block;"
                         onerror="this.onerror=null;this.src='{{ $package->destination->featured_image }}';">
                </div>

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title mb-1">{{ $package->name }}</h5>
                    <p class="card-text text-muted small mb-3">{{ Str::limit($package->description, 90) }}</p>

                    <div class="mt-auto d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-bold text-primary">${{ number_format($package->price, 2) }}</div>
                            <div class="text-muted small">{{ $package->destination->name }} · {{ $package->duration_days }}d · Max {{ $package->max_people }}</div>
                        </div>

                        <div class="d-flex align-items-center">
                            <a href="{{ route('packages.show', $package->id) }}" class="btn btn-sm btn-outline-primary me-2">View</a>

                            @auth
                            <div class="btn-group">
                                <a href="{{ route('packages.edit', $package->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('packages.destroy', $package->id) }}" method="POST" onsubmit="return confirm('Delete this package?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $packages->links() }}
    </div>
</div>
@endsection