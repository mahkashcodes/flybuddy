<footer class="bg-dark text-white pt-5 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h5 class="fw-bold">
                    <i class="fas fa-plane"></i> Fly<span class="text-warning">Buddy</span>
                </h5>
                <p>Your trusted travel companion since 2024. Making travel dreams come true.</p>
                <div class="social-icons">
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            
            <div class="col-md-3">
                <h5 class="fw-bold">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}" class="text-white text-decoration-none">Home</a></li>
                    <li><a href="{{ route('destinations.index') }}" class="text-white text-decoration-none">Destinations</a></li>
                    <li><a href="{{ route('packages.index') }}" class="text-white text-decoration-none">Packages</a></li>
                    <li><a href="{{ route('contact') }}" class="text-white text-decoration-none">Contact Us</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Privacy Policy</a></li>
                </ul>
            </div>
            
            <div class="col-md-3">
                <h5 class="fw-bold">Contact Info</h5>
                <p>
                    <i class="fas fa-map-marker-alt me-2"></i> 123 Travel Street, Wanderlust City<br>
                    <i class="fas fa-phone me-2"></i> +1 (234) 567-8900<br>
                    <i class="fas fa-envelope me-2"></i> info@flybuddy.com<br>
                    <i class="fas fa-clock me-2"></i> Mon-Fri: 9AM-6PM
                </p>
            </div>
            
            <div class="col-md-3">
                <h5 class="fw-bold">Newsletter</h5>
                <p>Subscribe for travel deals and tips!</p>
                <form id="newsletter-form">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Your email" required>
                        <button class="btn btn-warning" type="submit">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <hr class="bg-light">
        
        <div class="row">
            <div class="col-md-12 text-center">
                <p>&copy; {{ date('Y') }} Fly Buddy Travel Agency. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>