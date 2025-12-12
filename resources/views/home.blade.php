@extends('layouts.app')

@section('title', 'Fly Buddy - Your Ultimate Travel Companion')

@section('hero')
<div class="hero-section position-relative">
    <div class="hero-image" style="background-image: url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');">
        <div class="hero-overlay">
            <div class="container text-center text-white">
                <h1 class="display-3 fw-bold mb-4">Discover Your Next Adventure</h1>
                <p class="lead mb-4">Explore breathtaking destinations with personalized travel packages</p>
                <a href="{{ route('destinations.index') }}" class="btn btn-warning btn-lg px-4">
                    <i class="fas fa-search"></i> Explore Packages
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Search Section -->
<div class="container py-5">
    <div class="search-card p-4 shadow-lg rounded-3">
        <h3 class="text-center mb-4">Where do you want to go?</h3>
        <form action="{{ route('packages.search') }}" method="GET">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Destination</label>
                        <input type="text" class="form-control" id="destination-search" 
                               placeholder="Search destinations..." autocomplete="off">
                        <div id="destination-results" class="search-results"></div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label">Travel Date</label>
                        <input type="date" class="form-control" name="date">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label">Duration</label>
                        <select class="form-select" name="duration">
                            <option value="">Any</option>
                            <option value="1-3">1-3 Days</option>
                            <option value="4-7">4-7 Days</option>
                            <option value="8-14">8-14 Days</option>
                            <option value="15+">15+ Days</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label">Travelers</label>
                        <input type="number" class="form-control" name="travelers" min="1" value="1">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Search Packages
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Featured Destinations -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <h2 class="text-center fw-bold">Popular Destinations</h2>
                <p class="text-center text-muted">Explore our most sought-after travel spots</p>
            </div>
        </div>
        <div class="row" id="featured-destinations">
            <!-- Loaded via Ajax -->
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Travel Packages -->
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <h2 class="text-center fw-bold">Best Travel Packages</h2>
                <p class="text-center text-muted">Curated packages for unforgettable experiences</p>
            </div>
        </div>
        <div class="row" id="featured-packages">
            <!-- Loaded via Ajax -->
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Why Choose Fly Buddy?</h2>
        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <div class="p-4">
                    <div class="icon-circle mb-3">
                        <i class="fas fa-shield-alt fa-2x text-primary"></i>
                    </div>
                    <h5>Safe Travel</h5>
                    <p>Your safety is our top priority with 24/7 support</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="p-4">
                    <div class="icon-circle mb-3">
                        <i class="fas fa-dollar-sign fa-2x text-success"></i>
                    </div>
                    <h5>Best Price</h5>
                    <p>Guaranteed best prices or we'll match it</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="p-4">
                    <div class="icon-circle mb-3">
                        <i class="fas fa-headset fa-2x text-warning"></i>
                    </div>
                    <h5>24/7 Support</h5>
                    <p>Round-the-clock customer service</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="p-4">
                    <div class="icon-circle mb-3">
                        <i class="fas fa-gem fa-2x text-info"></i>
                    </div>
                    <h5>Premium Experience</h5>
                    <p>Handpicked hotels and experiences</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Load featured destinations via Ajax
    $.ajax({
        url: '/api/featured-destinations',
        method: 'GET',
        success: function(destinations) {
            let html = '';
            destinations.forEach(destination => {
                html += `
                    <div class="col-md-3 mb-4">
                        <div class="card destination-card h-100">
                            <img src="${destination.image || '/images/default-destination.jpg'}" 
                                 class="card-img-top" alt="${destination.name}">
                            <div class="card-body">
                                <h5 class="card-title">${destination.name}</h5>
                                <p class="card-text">${destination.description.substring(0, 80)}...</p>
                                <span class="badge bg-primary">${destination.country}</span>
                            </div>
                            <div class="card-footer">
                                <a href="/destinations/${destination.id}" class="btn btn-sm btn-outline-primary">
                                    Explore <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                `;
            });
            $('#featured-destinations').html(html);
        }
    });
    
    // Load featured packages via Ajax
    $.ajax({
        url: '/api/featured-packages',
        method: 'GET',
        success: function(packages) {
            let html = '';
            packages.forEach(package => {
                html += `
                    <div class="col-md-4 mb-4">
                        <div class="card package-card h-100">
                            <img src="${package.image || '/images/default-package.jpg'}" 
                                 class="card-img-top" alt="${package.title}">
                            <div class="card-body">
                                <h5 class="card-title">${package.title}</h5>
                                <p class="card-text">${package.description.substring(0, 100)}...</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h5 text-primary mb-0">$${package.price}</span>
                                    <span class="badge bg-info">${package.duration} days</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="/packages/${package.id}" class="btn btn-primary btn-sm">
                                    View Details
                                </a>
                                <a href="/packages/${package.id}/book" class="btn btn-warning btn-sm">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                `;
            });
            $('#featured-packages').html(html);
        }
    });
    
    // Destination search with Ajax
    $('#destination-search').on('keyup', function() {
        let query = $(this).val();
        
        if(query.length > 2) {
            $.ajax({
                url: '/api/destinations/search',
                method: 'GET',
                data: {query: query},
                success: function(results) {
                    let html = '<div class="list-group">';
                    results.forEach(destination => {
                        html += `
                            <a href="/destinations/${destination.id}" class="list-group-item list-group-item-action">
                                <strong>${destination.name}</strong>, ${destination.country}
                            </a>
                        `;
                    });
                    html += '</div>';
                    $('#destination-results').html(html).show();
                }
            });
        } else {
            $('#destination-results').hide().empty();
        }
    });
});
</script>
@endsection