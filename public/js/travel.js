// Fly Buddy Travel Website JS
$(document).ready(function() {
    
    // Auto-hide alerts
    setTimeout(() => {
        $('.alert').fadeOut('slow');
    }, 5000);
    
    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();
    
    // Initialize popovers
    $('[data-bs-toggle="popover"]').popover();
    
    // Newsletter form submission
    $('#newsletter-form').on('submit', function(e) {
        e.preventDefault();
        const email = $(this).find('input[type="email"]').val();
        
        $.ajax({
            url: '/newsletter/subscribe',
            method: 'POST',
            data: {email: email, _token: $('meta[name="csrf-token"]').attr('content')},
            success: function(response) {
                alert('Thank you for subscribing!');
                $('#newsletter-form')[0].reset();
            },
            error: function() {
                alert('Subscription failed. Please try again.');
            }
        });
    });
    
    // Image preview for forms
    window.previewTravelImage = function(input, previewId) {
        const preview = $(`#${previewId}`);
        const file = input.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if (preview.is('img')) {
                    preview.attr('src', e.target.result);
                } else {
                    preview.html(`
                        <div class="image-preview-container">
                            <img src="${e.target.result}" class="img-fluid rounded">
                            <small class="text-muted">${file.name}</small>
                        </div>
                    `);
                }
            }
            reader.readAsDataURL(file);
        }
    };
    
    // Price formatter
    window.formatPrice = function(price) {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 2
        }).format(price);
    };
    
    // Duration formatter
    window.formatDuration = function(days) {
        if (days === 1) return '1 day';
        if (days < 7) return `${days} days`;
        if (days === 7) return '1 week';
        if (days < 30) return `${Math.floor(days/7)} weeks`;
        if (days === 30) return '1 month';
        return `${Math.floor(days/30)} months`;
    };
    
    // Smooth scroll for anchor links
    $('a[href^="#"]').on('click', function(e) {
        if (this.hash !== "") {
            e.preventDefault();
            const hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top - 80
            }, 800);
        }
    });
    
    // Back to top button
    const backToTopButton = $('#back-to-top');
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            backToTopButton.fadeIn();
        } else {
            backToTopButton.fadeOut();
        }
    });
    
    backToTopButton.on('click', function() {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });
    
    // Form validation
    $('form').on('submit', function() {
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();
        
        submitBtn.prop('disabled', true);
        submitBtn.html(`
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Processing...
        `);
        
        // Re-enable button if form submission fails
        setTimeout(() => {
            submitBtn.prop('disabled', false);
            submitBtn.html(originalText);
        }, 10000); // Re-enable after 10 seconds
    });
});

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    console.log('Fly Buddy Travel Website Loaded');
});