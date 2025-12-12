@extends('layouts.app')

@section('title', 'Destinations - Fly Buddy')

@section('content')
<div class="container py-5 mt-4">
    <!-- Hero Section for Destinations -->
    <div class="row mb-5">
        <div class="col">
            <h1 class="display-4 fw-bold text-center">Explore Dream Destinations</h1>
            <p class="lead text-center text-muted">Discover amazing places around the world</p>
        </div>
    </div>
    
    <!-- Search and Filter -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="input-group">
                <input type="text" id="search-destinations" class="form-control form-control-lg" 
                       placeholder="Search destinations by name, country, or continent...">
                <button class="btn btn-primary btn-lg" type="button" id="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div id="search-results" class="search-results-dropdown"></div>
        </div>
        <div class="col-md-4">
            <select id="continent-filter" class="form-select form-select-lg">
                <option value="">Filter by Continent</option>
                <option value="Asia">Asia</option>
                <option value="Europe">Europe</option>
                <option value="North America">North America</option>
                <option value="South America">South America</option>
                <option value="Africa">Africa</option>
                <option value="Australia">Australia</option>
                <option value="Antarctica">Antarctica</option>
            </select>
        </div>
    </div>
    
    <!-- Admin Controls -->
    @auth
    <div class="row mb-4">
        <div class="col">
            <a href="{{ route('destinations.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Add New Destination
            </a>
        </div>
    </div>
    @endauth
    
    <!-- Destinations Grid -->
    <div class="row" id="destinations-container">
        @forelse($destinations as $destination)
        <div class="col-md-4 mb-4 destination-item" 
             data-continent="{{ $destination->continent }}">
            <div class="card h-100 shadow-sm">
                <div class="position-relative">
                    <img src="{{ $destination->featured_image ? asset('storage/' . $destination->featured_image) : '/images/default-destination.jpg' }}" 
                         class="card-img-top destination-image" alt="{{ $destination->name }}">
                    <div class="destination-badge">
                        <span class="badge bg-warning">{{ $destination->continent }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $destination->name }}</h5>
                    <p class="card-text">{{ Str::limit($destination->description, 120) }}</p>
                    
                    <div class="destination-meta mb-3">
                        <span class="text-muted">
                            <i class="fas fa-map-marker-alt"></i> {{ $destination->country }}
                        </span>
                        <span class="ms-3 text-muted">
                            <i class="fas fa-calendar"></i> Best time: {{ $destination->best_time_to_visit }}
                        </span>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="h5 text-primary">From ${{ number_format($destination->starting_price, 2) }}</span>
                            <br>
                            <small class="text-muted">Starting price</small>
                        </div>
                        <a href="{{ route('destinations.show', $destination) }}" class="btn btn-outline-primary">
                            Explore <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @auth
                <div class="card-footer bg-transparent">
                    <div class="btn-group w-100">
                        <a href="{{ route('destinations.edit', $destination) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('destinations.destroy', $destination) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Delete this destination?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </div>
        @empty
        <div class="col">
            <div class="alert alert-info">
                <h4 class="alert-heading">No destinations found!</h4>
                <p>Check back soon or add some destinations if you're an admin.</p>
            </div>
        </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    @if($destinations->hasPages())
    <div class="row mt-4">
        <div class="col">
            {{ $destinations->links() }}
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Search destinations with Ajax
    $('#search-destinations').on('keyup', function() {
        let query = $(this).val();
        
        if(query.length > 2) {
            $.ajax({
                url: '{{ route("destinations.search") }}',
                method: 'GET',
                data: {query: query},
                success: function(data) {
                    let html = '<div class="list-group">';
                    data.forEach(destination => {
                        html += `
                            <a href="/destinations/${destination.id}" class="list-group-item list-group-item-action">
                                <strong>${destination.name}</strong>, ${destination.country}
                                <br><small>${destination.continent} - From $${destination.starting_price}</small>
                            </a>
                        `;
                    });
                    html += '</div>';
                    $('#search-results').html(html).show();
                }
            });
        } else {
            $('#search-results').hide();
        }
    });
    
    // Filter by continent
    $('#continent-filter').on('change', function() {
        const continent = $(this).val();
        
        if(continent) {
            $('.destination-item').hide();
            $(`.destination-item[data-continent="${continent}"]`).show();
        } else {
            $('.destination-item').show();
        }
    });
    
    // Hide search results when clicking elsewhere
    $(document).click(function(e) {
        if(!$(e.target).closest('#search-destinations, #search-results').length) {
            $('#search-results').hide();
        }
    });
});
</script>
@endsection