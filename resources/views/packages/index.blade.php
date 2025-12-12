@extends('layouts.app')

@section('title', 'Travel Packages - Fly Buddy')

@section('content')
<div class="container py-5 mt-4">
    <div class="row mb-5">
        <div class="col">
            <h1 class="display-4 fw-bold text-center">Travel Packages</h1>
            <p class="lead text-center text-muted">Amazing travel experiences curated just for you</p>
        </div>
    </div>
    
    <div class="alert alert-info">
        <h4 class="alert-heading">Coming Soon!</h4>
        <p>Travel Packages module is under development. Check back soon!</p>
        <hr>
        <p class="mb-0">
            <a href="{{ route('destinations.index') }}" class="btn btn-primary">
                Explore Destinations Instead
            </a>
        </p>
    </div>
</div>
@endsection