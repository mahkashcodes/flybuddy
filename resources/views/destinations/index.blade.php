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
    
    <!-- Ajax Search and Filter -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="input-group">
                <input type="text" id="search-destinations" class="form-control form-control-lg" 
                       placeholder="Search destinations by name, country, or continent..." 
                       autocomplete="off">
                <button class="btn btn-primary btn-lg" type="button" id="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <!-- Ajax Search Results Dropdown -->
            <div id="search-results" class="search-results-dropdown mt-1" style="display: none;"></div>
        </div>
        <div class="col-md-4">
            <select id="continent-filter" class="form-select form-select-lg">
                <option value="">All Continents</option>
                <option value="Asia">Asia</option>
                <option value="Europe">Europe</option>
                <option value="North America">North America</option>
                <option value="South America">South America</option>
                <option value="Africa">Africa</option>
                <option value="Oceania">Oceania</option>
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
                    <!-- FIXED IMAGE URL - Using direct external URL -->
                    <img src="{{ $destination->featured_image ? $destination->featured_image : 'https://images.pexels.com/photos/338515/pexels-photo-338515.jpeg' }}" 
                         class="card-img-top destination-image" alt="{{ $destination->name }}" 
                         style="height: 250px; object-fit: cover; width: 100%;"
                         onerror="this.src='https://images.pexels.com/photos/338515/pexels-photo-338515.jpeg'">
                    <div class="destination-badge" style="position: absolute; top: 15px; right: 15px;">
                        <span class="badge bg-warning">{{ $destination->continent }}</span>
                        @if($destination->is_featured)
                        <span class="badge bg-danger ms-1">⭐ Featured</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $destination->name }}</h5>
                    <p class="card-text">{{ Str::limit($destination->description, 120) }}</p>
                    
                    <div class="destination-meta mb-3">
                        <span class="text-muted">
                            <i class="fas fa-map-marker-alt"></i> {{ $destination->country }}
                        </span>
                        @if($destination->best_time_to_visit)
                        <span class="ms-3 text-muted">
                            <i class="fas fa-calendar"></i> {{ $destination->best_time_to_visit }}
                        </span>
                        @endif
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="h5 text-primary">${{ number_format($destination->starting_price, 0) }}</span>
                            <br>
                            <small class="text-muted">Starting price</small>
                        </div>
                        <a href="{{ route('destinations.show', $destination->id) }}" class="btn btn-outline-primary">
                            Explore <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @auth
                <div class="card-footer bg-transparent">
                    <div class="btn-group w-100">
                        <a href="{{ route('destinations.edit', $destination->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('destinations.destroy', $destination->id) }}" method="POST" class="d-inline">
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
                @auth
                <a href="{{ route('destinations.create') }}" class="btn btn-primary mt-2">
                    <i class="fas fa-plus"></i> Add Your First Destination
                </a>
                @endauth
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
    let searchTimeout;
    
    // Ajax search for destinations
    $('#search-destinations').on('keyup', function() {
        clearTimeout(searchTimeout);
        const query = $(this).val().trim();
        const resultsDiv = $('#search-results');
        
        if (query.length < 2) {
            resultsDiv.hide().empty();
            return;
        }
        
        searchTimeout = setTimeout(function() {
            $.ajax({
                url: '{{ route("destinations.search") }}',
                method: 'GET',
                data: { query: query },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    resultsDiv.html('<div class="list-group-item"><div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div> Searching...</div>').show();
                },
                success: function(response) {
                    if (response.length > 0) {
                        let html = '<div class="list-group">';
                        response.forEach(destination => {
                            // FIXED: Use direct image URL, not storage path
                            const imageUrl = destination.featured_image 
                                ? destination.featured_image 
                                : 'https://images.pexels.com/photos/338515/pexels-photo-338515.jpeg';
                            
                            html += `
                                <a href="/destinations/${destination.id}" class="list-group-item list-group-item-action">
                                    <div class="d-flex align-items-center">
                                        <img src="${imageUrl}" class="rounded me-3" width="50" height="50" style="object-fit: cover;">
                                        <div>
                                            <strong>${destination.name}</strong>
                                            <div class="text-muted small">
                                                ${destination.country}, ${destination.continent}
                                                <span class="ms-2 text-primary">$${destination.starting_price}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            `;
                        });
                        html += '<div class="list-group-item text-center small text-muted">Click to view destination</div>';
                        html += '</div>';
                        resultsDiv.html(html).show();
                    } else {
                        resultsDiv.html('<div class="list-group-item text-muted">No destinations found. Try different keywords.</div>').show();
                    }
                },
                error: function() {
                    resultsDiv.html('<div class="list-group-item text-danger">Search failed. Please try again.</div>').show();
                }
            });
        }, 300);
    });
    
    // Hide results when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#search-destinations, #search-results').length) {
            $('#search-results').hide();
        }
    });
    
    // Filter by continent
    $('#continent-filter').on('change', function() {
        const continent = $(this).val();
        if (!continent) {
            $('.destination-item').show();
            return;
        }
        
        $('.destination-item').each(function() {
            const itemContinent = $(this).data('continent');
            if (itemContinent === continent) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    
    // Enter key to search
    $('#search-destinations').on('keypress', function(e) {
        if (e.which === 13) {
            e.preventDefault();
            const query = $(this).val().trim();
            if (query.length > 1) {
                window.location.href = '/destinations?search=' + encodeURIComponent(query);
            }
        }
    });
    
    // Search button click
    $('#search-btn').on('click', function() {
        const query = $('#search-destinations').val().trim();
        if (query.length > 1) {
            window.location.href = '/destinations?search=' + encodeURIComponent(query);
        }
    });
});
</script>

<style>
.search-results-dropdown {
    position: absolute;
    z-index: 1050;
    background: white;
    width: 100%;
    border: 1px solid #dee2e6;
    border-top: none;
    border-radius: 0 0 5px 5px;
    max-height: 400px;
    overflow-y: auto;
    box-shadow: 0 6px 12px rgba(0,0,0,0.175);
}

.search-results-dropdown .list-group-item {
    border-left: none;
    border-right: none;
    border-radius: 0;
    padding: 10px 15px;
}

.search-results-dropdown .list-group-item:last-child {
    border-bottom: none;
}

.search-results-dropdown .list-group-item:hover {
    background-color: #f8f9fa;
    cursor: pointer;
}

.destination-item {
    transition: all 0.3s ease;
}

.destination-image {
    transition: transform 0.3s ease;
}

.destination-image:hover {
    transform: scale(1.05);
}

.card {
    transition: box-shadow 0.3s ease;
}

.card:hover {
    box-shadow: 0 10px 30px rgba(0,0,0,0.2) !important;
}
</style>
@endsection