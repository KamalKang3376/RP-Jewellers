@extends('admin.layouts.app')

@section('title', 'Create Category')

@push('styles')
    <link rel="stylesheet" href="{{ secure_asset('css/admin/categories-create.css') }}">
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Create Category</h1>
            <p class="text-muted mb-0">Add a new product category.</p>
        </div>

        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>
            Back to Categories
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Category Details</h5>
                </div>

                <div class="card-body">
                    <form
                        action="{{ route('admin.categories.store', [], false) }}"
                        method="POST"
                        enctype="multipart/form-data"
                        id="categoryForm"
                    >
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Category Name <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                placeholder="Enter category name"
                                maxlength="255"
                                required
                            >

                            <small class="text-muted">
                                Example: Rings, Necklaces, Earrings
                            </small>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">
                                Category Image
                            </label>

                            <input
                                type="file"
                                id="image"
                                name="image"
                                class="form-control"
                                accept="image/jpeg,image/png,image/webp,image/jpg"
                            >

                            <small class="text-muted">
                                Select a JPG, JPEG, PNG, or WEBP image.
                                Maximum size depends on your controller validation.
                            </small>
                        </div>

                        <div class="mb-3" id="imagePreviewWrapper" style="display: none;">
                            <label class="form-label">Selected Image</label>

                            <div>
                                <img
                                    id="imagePreview"
                                    src=""
                                    alt="Category image preview"
                                    style="max-width: 180px; max-height: 180px; object-fit: contain;"
                                    class="img-thumbnail"
                                >
                            </div>

                            <button
                                type="button"
                                class="btn btn-sm btn-outline-danger mt-2"
                                id="removeImage"
                            >
                                <i class="fas fa-times me-1"></i>
                                Remove Image
                            </button>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="form-label">
                                Status <span class="text-danger">*</span>
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="form-select"
                                required
                            >
                                <option
                                    value="1"
                                    {{ old('status', '1') == '1' ? 'selected' : '' }}
                                >
                                    Active
                                </option>

                                <option
                                    value="0"
                                    {{ old('status', '1') == '0' ? 'selected' : '' }}
                                >
                                    Inactive
                                </option>
                            </select>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                Create Category
                            </button>

                            <a
                                href="{{ route('admin.categories.index') }}"
                                class="btn btn-light border"
                            >
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Category Preview</h5>
                </div>

                <div class="card-body">
                    <div class="text-center">
                        <div
                            id="categoryPreviewImage"
                            class="mb-3"
                            style="min-height: 180px; display: flex; align-items: center; justify-content: center;"
                        >
                            <div id="previewImagePlaceholder" class="text-muted">
                                <i class="fas fa-image fa-4x mb-2"></i>
                                <p class="mb-0">Your image preview will appear here.</p>
                            </div>
                        </div>

                        <h5 id="categoryNamePreview" class="mb-2">
                            Category Name
                        </h5>

                        <span id="categoryStatusPreview" class="badge bg-success">
                            Active
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const categoryForm = document.getElementById('categoryForm');
    const nameInput = document.getElementById('name');
    const imageInput = document.getElementById('image');
    const statusInput = document.getElementById('status');

    const imagePreviewWrapper = document.getElementById('imagePreviewWrapper');
    const imagePreview = document.getElementById('imagePreview');
    const removeImageButton = document.getElementById('removeImage');

    const categoryNamePreview = document.getElementById('categoryNamePreview');
    const categoryStatusPreview = document.getElementById('categoryStatusPreview');
    const categoryPreviewImage = document.getElementById('categoryPreviewImage');

    const previewImagePlaceholder = document.getElementById('previewImagePlaceholder');

    nameInput.addEventListener('input', function () {
        categoryNamePreview.textContent = this.value.trim() || 'Category Name';
    });

    statusInput.addEventListener('change', function () {
        if (this.value === '1') {
            categoryStatusPreview.textContent = 'Active';
            categoryStatusPreview.className = 'badge bg-success';
        } else {
            categoryStatusPreview.textContent = 'Inactive';
            categoryStatusPreview.className = 'badge bg-secondary';
        }
    });

    imageInput.addEventListener('change', function () {
        const file = this.files && this.files[0];

        if (!file) {
            return;
        }

        if (!file.type.startsWith('image/')) {
            alert('Please select a valid image file.');
            this.value = '';
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {
            imagePreview.src = event.target.result;
            imagePreviewWrapper.style.display = 'block';

            previewImagePlaceholder.style.display = 'none';

            let existingPreview = categoryPreviewImage.querySelector('img');

            if (!existingPreview) {
                existingPreview = document.createElement('img');
                existingPreview.alt = 'Category preview';
                existingPreview.style.maxWidth = '100%';
                existingPreview.style.maxHeight = '180px';
                existingPreview.style.objectFit = 'contain';
                existingPreview.className = 'img-fluid rounded';

                categoryPreviewImage.appendChild(existingPreview);
            }

            existingPreview.src = event.target.result;
        };

        reader.readAsDataURL(file);
    });

    removeImageButton.addEventListener('click', function () {
        imageInput.value = '';
        imagePreview.src = '';
        imagePreviewWrapper.style.display = 'none';

        const existingPreview = categoryPreviewImage.querySelector('img');

        if (existingPreview) {
            existingPreview.remove();
        }

        previewImagePlaceholder.style.display = 'block';
    });

    categoryForm.addEventListener('submit', function (event) {
        if (!nameInput.value.trim()) {
            event.preventDefault();
            alert('Please enter a category name.');
            nameInput.focus();
        }
    });
});
</script>
@endpush
