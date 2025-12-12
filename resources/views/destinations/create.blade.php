@extends('layouts.app')

@section('title', 'Add Destination - Fly Buddy')

@section('content')
<div class="container py-5 mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-plus me-2"></i> Add New Destination</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('destinations.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Destination Name *</label>
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
                                <label for="country" class="form-label">Country *</label>
                                <input type="text" class="form-control" id="country" name="country" 
                                       value="{{ old('country') }}" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="continent" class="form-label">Continent *</label>
                                <select class="form-select" id="continent" name="continent" required>
                                    <option value="">Select Continent</option>
                                    <option value="Asia" {{ old('continent') == 'Asia' ? 'selected' : '' }}>Asia</option>
                                    <option value="Europe" {{ old('continent') == 'Europe' ? 'selected' : '' }}>Europe</option>
                                    <option value="North America" {{ old('continent') == 'North America' ? 'selected' : '' }}>North America</option>
                                    <option value="South America" {{ old('continent') == 'South America' ? 'selected' : '' }}>South America</option>
                                    <option value="Africa" {{ old('continent') == 'Africa' ? 'selected' : '' }}>Africa</option>
                                    <option value="Australia" {{ old('continent') == 'Australia' ? 'selected' : '' }}>Australia</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="best_time_to_visit" class="form-label">Best Time to Visit</label>
                                <input type="text" class="form-control" id="best_time_to_visit" 
                                       name="best_time_to_visit" value="{{ old('best_time_to_visit') }}">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="starting_price" class="form-label">Starting Price (USD) *</label>
                                <input type="number" step="0.01" class="form-control" id="starting_price" 
                                       name="starting_price" value="{{ old('starting_price') }}" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="featured_image" class="form-label">Featured Image</label>
                            <input type="file" class="form-control" id="featured_image" 
                                   name="featured_image" accept="image/*">
                        </div>
                        
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" 
                                       id="is_featured" name="is_featured" value="1"
                                       {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    Mark as Featured Destination
                                </label>
                            </div>
                            
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" 
                                       id="is_active" name="is_active" value="1"
                                       {{ old('is_active', true) ? 'checked' : '' }}>
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
                                <i class="fas fa-save me-1"></i> Save Destination
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
                <small class="text-muted">Preview: ${file.name}</small>
            `;
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection