@extends('layouts.app')

@section('content')

<!-- Section 1: Home -->
<section id="home" class="text-center my-5">
    <h1>Welcome to FlyBuddy</h1>
    <p>Your one-stop solution for travel planning!</p>
</section>

<!-- Section 2: About -->
<section id="about" class="my-5">
    <h2>About Us</h2>
    <p>FlyBuddy is dedicated to making your trips unforgettable.</p>
</section>

<!-- Section 3: Contact -->
<section id="contact" class="my-5">
    <h2>Contact Us</h2>
    <form>
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" class="form-control" placeholder="Enter your name">
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" class="form-control" placeholder="Enter your email">
        </div>
        <div class="mb-3">
            <label>Message:</label>
            <textarea class="form-control" placeholder="Your message"></textarea>
        </div>
        <button class="btn btn-primary">Send</button>
    </form>
</section>

@endsection
