@extends('layouts.app')

@section('title', 'Checkout - Fly Buddy')

@section('content')
<div class="container py-5 mt-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Customer Information</h5>
                </div>
                <div class="card-body">
                    <form id="checkout-form">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>First Name *</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Last Name *</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email *</label>
                                <input type="email" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phone *</label>
                                <input type="tel" class="form-control" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label>Address *</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>City *</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Zip Code *</label>
                                <input type="text" class="form-control" required>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-receipt"></i> Order Summary</h5>
                </div>
                <div class="card-body">
                    @foreach($cart as $item)
                    <div class="d-flex justify-content-between mb-2">
                        <span>{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
                        <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                    </div>
                    @endforeach
                    
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <strong>Total:</strong>
                        <strong>${{ number_format($total, 2) }}</strong>
                    </div>
                    
                    <button class="btn btn-success w-100 btn-lg mt-3" onclick="processCheckout()">
                        <i class="fas fa-lock"></i> Complete Order
                    </button>
                    
                    <div class="mt-3 text-center">
                        <img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppmcvdam.png" 
                             alt="Payment Options" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function processCheckout() {
    if (document.getElementById('checkout-form').checkValidity()) {
        // In a real app, you would process payment here
        // For demo, just show success
        alert('Order placed successfully! This is a demo. In a real app, you would integrate with payment gateway.');
        window.location.href = "{{ route('cart.success') }}";
    } else {
        alert('Please fill in all required fields.');
    }
}
</script>
@endsection