@extends('layouts.app')

@section('title', 'Create Package - Fly Buddy')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-plus"></i> Create New Travel Package</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('packages.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="destination_id" class="form-label">Destination *</label>
                            <select name="destination_id" id="destination_id" class="form-select" required>
                                <option value="">Select Destination</option>
                                @foreach($destinations as $destination)
                                <option value="{{ $destination->id }}" {{ old('destination_id') == $destination->id ? 'selected' : '' }}>
                                    {{ $destination->name }} ({{ $destination->country }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Package Name *</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ old('name') }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Description *</label>
                            <textarea class="form-control" id="description" name="description" 
                                      rows="4" required>{{ old('description') }}</textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="duration_days" class="form-label">Duration (days) *</label>
                                <input type="number" class="form-control" id="duration_days" 
                                       name="duration_days" value="{{ old('duration_days', 5) }}" min="1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Price ($) *</label>
                                <input type="number" class="form-control" id="price" 
                                       name="price" value="{{ old('price') }}" step="0.01" min="0" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="max_people" class="form-label">Max People *</label>
                                <input type="number" class="form-control" id="max_people" 
                                       name="max_people" value="{{ old('max_people', 10) }}" min="1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="image_url" class="form-label">Image URL (optional)</label>
                                <input type="url" class="form-control" id="image_url" 
                                       name="image_url" value="{{ old('image_url') }}" 
                                       placeholder="https://images.pexels.com/...">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="inclusions" class="form-label">Inclusions (comma separated)</label>
                            <input type="text" class="form-control" id="inclusions" 
                                   name="inclusions" value="{{ old('inclusions') }}"
                                   placeholder="Flight, Hotel, Breakfast, Guide">
                            <small class="text-muted">Separate items with commas</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="exclusions" class="form-label">Exclusions (comma separated)</label>
                            <input type="text" class="form-control" id="exclusions" 
                                   name="exclusions" value="{{ old('exclusions') }}"
                                   placeholder="Insurance, Visa, Alcohol">
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" 
                                   name="is_active" value="1" checked>
                            <label class="form-check-label" for="is_active">Active (visible to users)</label>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('packages.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Package
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection