@extends('layouts.app')

@section('title', 'Edit ' . $destination->name . ' - Fly Buddy')

@section('content')
<div class="container py-5 mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Destination: {{ $destination->name }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('destinations.update', $destination->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Destination Name *</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ old('name', $destination->name) }}" required>
                            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Description *</label>
                            <textarea class="form-control" id="description" name="description" 
                                      rows="4" required>{{ old('description', $destination->description) }}</textarea>
                            @error('description')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="country" class="form-label">Country *</label>
                                <input type="text" class="form-control" id="country" name="country" 
                                       value="{{ old('country', $destination->country) }}" required>
                                @error('country')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="continent" class="form-label">Continent *</label>
                                <select class="form-select" id="continent" name="continent" required>
                                    <option value="Asia" {{ $destination->continent == 'Asia' ? 'selected' : '' }}>Asia</option>
                                    <option value="Europe" {{ $destination->continent == 'Europe' ? 'selected' : '' }}>Europe</option>
                                    <option value="North America" {{ $destination->continent == 'North America' ? 'selected' : '' }}>North America</option>
                                    <option value="South America" {{ $destination->continent == 'South America' ? 'selected' : '' }}>South America</option>
                                    <option value="Africa" {{ $destination->continent == 'Africa' ? 'selected' : '' }}>Africa</option>
                                    <option value="Australia" {{ $destination->continent == 'Australia' ? 'selected' : '' }}>Australia</option>
                                </select>
                                @error('continent')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="best_time_to_visit" class="form-label">Best Time to Visit</label>
                                <input type="text" class="form-control" id="best_time_to_visit" 
                                       name="best_time_to_visit" value="{{ old('best_time_to_visit', $destination->best_time_to_visit) }}">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="starting_price" class="form-label">Starting Price (USD) *</label>
                                <input type="number" step="0.01" class="form-control" id="starting_price" 
                                       name="starting_price" value="{{ old('starting_price', $destination->starting_price) }}" required>
                                @error('starting_price')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="featured_image" class="form-label">Featured Image</label>
                            @if($destination->featured_image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $destination->featured_image) }}" 
                                     class="img-fluid rounded" style="max-height: 200px;">
                                <small class="text-muted d-block">Current image</small>
                            </div>
                            @endif
                            <input type="file" class="form-control" id="featured_image" 
                                   name="featured_image" accept="image/*">
                            @error('featured_image')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" 
                                       id="is_featured" name="is_featured" value="1"
                                       {{ old('is_featured', $destination->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    Mark as Featured Destination
                                </label>
                            </div>
                            
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" 
                                       id="is_active" name="is_active" value="1"
                                       {{ old('is_active', $destination->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active (Visible on website)
                                </label>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('destinations.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Destination
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('featured_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            let preview = document.getElementById('image-preview');
            if (!preview) {
                preview = document.createElement('div');
                preview.id = 'image-preview';
                preview.className = 'mt-2';
                document.getElementById('featured_image').parentNode.appendChild(preview);
            }
            preview.innerHTML = `
                <img src="${e.target.result}" class="img-fluid rounded" style="max-height: 200px;">
                <small class="text-muted">New image preview: ${file.name}</small>
            `;
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection