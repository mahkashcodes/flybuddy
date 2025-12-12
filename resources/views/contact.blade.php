@extends('layouts.app')

@section('title', 'Contact Us - Fly Buddy')

@section('content')
<div class="container py-5 mt-4">
    <div class="row">
        <!-- Contact Form -->
        <div class="col-lg-8 mb-5">
            <h1 class="mb-4">Get In Touch</h1>
            <p class="lead mb-4">Have questions about our travel packages? We're here to help!</p>
            
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            
            <form action="{{ route('contact.submit') }}" method="POST" id="contact-form">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Full Name *</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="{{ old('name') }}" required>
                        @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email Address *</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="{{ old('email') }}" required>
                        @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject *</label>
                    <select class="form-select" id="subject" name="subject" required>
                        <option value="">Select a subject</option>
                        <option value="Booking Inquiry" {{ old('subject') == 'Booking Inquiry' ? 'selected' : '' }}>
                            Booking Inquiry
                        </option>
                        <option value="Package Customization" {{ old('subject') == 'Package Customization' ? 'selected' : '' }}>
                            Package Customization
                        </option>
                        <option value="Group Travel" {{ old('subject') == 'Group Travel' ? 'selected' : '' }}>
                            Group Travel
                        </option>
                        <option value="Cancellation/Refund" {{ old('subject') == 'Cancellation/Refund' ? 'selected' : '' }}>
                            Cancellation/Refund
                        </option>
                        <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>
                            Other
                        </option>
                    </select>
                    @error('subject')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                
                <div class="mb-3">
                    <label for="message" class="form-label">Your Message *</label>
                    <textarea class="form-control" id="message" name="message" 
                              rows="6" required>{{ old('message') }}</textarea>
                    @error('message')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter" 
                               {{ old('newsletter') ? 'checked' : '' }}>
                        <label class="form-check-label" for="newsletter">
                            Subscribe to our newsletter for travel deals
                        </label>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg px-5">
                    <i class="fas fa-paper-plane me-2"></i> Send Message
                </button>
            </form>
        </div>
        
        <!-- Contact Info -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h4 class="card-title mb-4">Contact Information</h4>
                    
                    <div class="contact-info-item mb-4">
                        <div class="icon-circle bg-primary text-white mb-3">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h5>Our Office</h5>
                        <p class="text-muted">
                            123 Travel Street<br>
                            Wanderlust City, WC 10001<br>
                            United States
                        </p>
                    </div>
                    
                    <div class="contact-info-item mb-4">
                        <div class="icon-circle bg-success text-white mb-3">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h5>Phone Numbers</h5>
                        <p class="text-muted">
                            <strong>Sales:</strong> +1 (234) 567-8901<br>
                            <strong>Support:</strong> +1 (234) 567-8902<br>
                            <strong>Emergency:</strong> +1 (234) 567-8903
                        </p>
                    </div>
                    
                    <div class="contact-info-item mb-4">
                        <div class="icon-circle bg-warning text-white mb-3">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h5>Email Addresses</h5>
                        <p class="text-muted">
                            <strong>Bookings:</strong> bookings@flybuddy.com<br>
                            <strong>Support:</strong> support@flybuddy.com<br>
                            <strong>General:</strong> info@flybuddy.com
                        </p>
                    </div>
                    
                    <div class="contact-info-item">
                        <div class="icon-circle bg-info text-white mb-3">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h5>Business Hours</h5>
                        <p class="text-muted">
                            <strong>Monday-Friday:</strong> 9:00 AM - 8:00 PM<br>
                            <strong>Saturday:</strong> 10:00 AM - 6:00 PM<br>
                            <strong>Sunday:</strong> 10:00 AM - 4:00 PM<br>
                            <small class="text-muted">All times in EST</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Map Section -->
    <div class="row mt-5">
        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="map-container">
                        <!-- Google Maps embed or static map -->
                        <div class="map-placeholder bg-light text-center p-5">
                            <i class="fas fa-map-marked-alt fa-4x text-muted mb-3"></i>
                            <h4>Our Location</h4>
                            <p class="text-muted">Interactive map would be here in production</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Form validation
    $('#contact-form').on('submit', function() {
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true);
        submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i> Sending...');
    });
});
</script>
@endsection