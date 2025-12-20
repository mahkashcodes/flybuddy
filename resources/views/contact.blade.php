
@extends('layouts.app')

@section('title', 'Contact Us - Fly Buddy')

@section('content')
<div class="container py-5 mt-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Package Reference -->
            @if(request()->has('package'))
            <div class="alert alert-info">
                <h5><i class="fas fa-info-circle"></i> Inquiry about: {{ request('package_name') }}</h5>
                <p class="mb-0">You're inquiring about the "{{ request('package_name') }}" package.</p>
            </div>
            @endif
            
            <h1 class="display-5 fw-bold text-center mb-4">Contact Us</h1>
            
            <div class="card shadow">
                <div class="card-body p-5">
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        
                        <!-- Hidden package field -->
                        @if(request()->has('package'))
                        <input type="hidden" name="package_id" value="{{ request('package') }}">
                        <input type="hidden" name="package_name" value="{{ request('package_name') }}">
                        @endif
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Your Name *</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Address *</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Subject *</label>
                            <input type="text" class="form-control" name="subject" 
                                   value="{{ request()->has('package') ? 'Inquiry about: ' . request('package_name') : '' }}" 
                                   required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Message *</label>
                            <textarea class="form-control" name="message" rows="6" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-paper-plane me-2"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Contact Info -->
            <div class="row mt-5">
                <div class="col-md-4 text-center mb-4">
                    <div class="p-3">
                        <i class="fas fa-phone fa-2x text-primary mb-3"></i>
                        <h5>Phone</h5>
                        <p class="text-muted">+1 (555) 123-4567</p>
                    </div>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="p-3">
                        <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
                        <h5>Email</h5>
                        <p class="text-muted">info@flybuddy.com</p>
                    </div>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="p-3">
                        <i class="fas fa-clock fa-2x text-primary mb-3"></i>
                        <h5>Business Hours</h5>
                        <p class="text-muted">Mon-Fri: 9AM-6PM<br>Sat: 10AM-4PM</p>
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