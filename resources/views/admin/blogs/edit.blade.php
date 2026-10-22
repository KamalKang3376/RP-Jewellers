@extends('admin.layouts.app')

@section('title', 'Edit Blog | Admin')

@section('page-title', 'Edit Blog')

@section('content')

<link rel="stylesheet" href="{{ secure_asset('css/admin/blog-edit.css') }}">
<div class="admin-blog-page">

    <div class="admin-page-header blog-page-header">
        <div>
            <span class="page-label">CONTENT MANAGEMENT</span>
            <h1>Edit Blog Post</h1>
            <p>Update your jewellery article and manage its publication status.</p>
        </div>

        <a href="{{ route('admin.blogs.index') }}" class="add-blog-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Blogs
        </a>
    </div>

    @if ($errors->any())
        <div class="blog-alert error">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>
                <strong>Please correct the following errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="blog-alert success">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="blog-card edit-blog-card">

        <div class="blog-card-header">
            <div>
                <h2>Blog Details</h2>
                <p>Make changes to your existing article below.</p>
            </div>
        </div>

        <div class="edit-blog-form-wrapper">

            <form
                action="{{ route('admin.blogs.update', $blog->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                <div class="row g-4">

                    <div class="col-lg-8">

                        <div class="form-section">

                            <div class="mb-4">
                                <label for="title" class="form-label">
                                    Blog Title <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    class="form-control"
                                    value="{{ old('title', $blog->title) }}"
                                    maxlength="255"
                                    required
                                >
                            </div>

                            <div class="mb-4">
                                <label for="category" class="form-label">
                                    Category <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="category"
                                    name="category"
                                    class="form-control"
                                    value="{{ old('category', $blog->category) }}"
                                    maxlength="255"
                                    required
                                >
                            </div>

                            <div class="mb-4">
                                <label for="excerpt" class="form-label">
                                    Short Excerpt
                                </label>

                                <textarea
                                    id="excerpt"
                                    name="excerpt"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Write a short introduction for your article..."
                                >{{ old('excerpt', $blog->excerpt) }}</textarea>
                            </div>

                            <div class="mb-0">
                                <label for="content" class="form-label">
                                    Blog Content <span class="text-danger">*</span>
                                </label>

                                <textarea
                                    id="content"
                                    name="content"
                                    class="form-control blog-content-field"
                                    rows="14"
                                    required
                                    placeholder="Write your jewellery article here..."
                                >{{ old('content', $blog->content) }}</textarea>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-4">

                        <div class="form-section">

                            <h4>
                                <i class="fa-regular fa-image me-2"></i>
                                Featured Image
                            </h4>

                            @if ($blog->image)

                                @php
                                    $imagePath = $blog->image;

                                    if (
                                        str_starts_with($imagePath, 'http://') ||
                                        str_starts_with($imagePath, 'https://')
                                    ) {
                                        $imageUrl = $imagePath;
                                    } elseif (str_starts_with($imagePath, 'blogs/')) {
                                        $imageUrl = asset('storage/' . $imagePath);
                                    } else {
                                        $imageUrl = asset('images/blog/' . basename($imagePath));
                                    }
                                @endphp

                                <div class="edit-blog-image-wrapper">
                                    <img
                                        src="{{ $imageUrl }}"
                                        class="edit-blog-image"
                                        alt="{{ $blog->title }}"
                                        onerror="this.onerror=null; this.style.display='none'; document.getElementById('blogImageFallback').style.display='flex';"
                                    >

                                    <div
                                        id="blogImageFallback"
                                        class="no-blog-image"
                                        style="display: none;"
                                    >
                                        <i class="fa-solid fa-image"></i>
                                        <span>Image unavailable</span>
                                    </div>
                                </div>

                            @else

                                <div class="no-blog-image">
                                    <i class="fa-solid fa-image"></i>
                                    <span>No image uploaded</span>
                                </div>

                            @endif

                            <label for="image" class="form-label mt-3">
                                Replace Image
                            </label>

                            <input
                                type="file"
                                id="image"
                                name="image"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            >

                            <small class="text-muted d-block mt-2">
                                Leave empty to keep the current image. JPG, PNG or WebP, maximum 2 MB.
                            </small>

                            <div id="newImagePreviewWrapper" class="mt-3" style="display: none;">
                                <label class="form-label">New Image Preview</label>
                                <img
                                    id="newImagePreview"
                                    class="edit-blog-image"
                                    alt="Selected blog image preview"
                                >
                            </div>

                        </div>

                        <div class="form-section mt-4">

                            <h4>
                                <i class="fa-regular fa-user me-2"></i>
                                Author
                            </h4>

                            <label for="author" class="form-label">
                                Author Name
                            </label>

                            <input
                                type="text"
                                id="author"
                                name="author"
                                class="form-control"
                                value="{{ old('author', $blog->author) }}"
                                maxlength="255"
                                placeholder="Enter author name"
                            >

                        </div>

                        <div class="form-section mt-4">

                            <h4>
                                <i class="fa-solid fa-toggle-on me-2"></i>
                                Publication Status
                            </h4>

                            <label for="status" class="form-label">
                                Status
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="form-select"
                                required
                            >
                                <option
                                    value="1"
                                    {{ (string) old('status', $blog->status) === '1' ? 'selected' : '' }}
                                >
                                    Published
                                </option>

                                <option
                                    value="0"
                                    {{ (string) old('status', $blog->status) === '0' ? 'selected' : '' }}
                                >
                                    Draft
                                </option>
                            </select>

                            <small class="text-muted d-block mt-2">
                                Published articles can appear on your public blog page.
                            </small>

                        </div>

                        <button type="submit" class="admin-btn w-100 mt-4">
                            <i class="fa-solid fa-floppy-disk me-2"></i>
                            Update Blog
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('image');
    const previewWrapper = document.getElementById('newImagePreviewWrapper');
    const previewImage = document.getElementById('newImagePreview');

    if (!imageInput || !previewWrapper || !previewImage) {
        return;
    }

    let previewUrl = null;

    imageInput.addEventListener('change', function () {
        const file = this.files && this.files[0];

        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }

        if (!file) {
            previewWrapper.style.display = 'none';
            previewImage.removeAttribute('src');
            return;
        }

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!allowedTypes.includes(file.type)) {
            alert('Please select a JPG, PNG or WebP image.');
            this.value = '';
            previewWrapper.style.display = 'none';
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('The image must be smaller than 2 MB.');
            this.value = '';
            previewWrapper.style.display = 'none';
            return;
        }

        previewUrl = URL.createObjectURL(file);
        previewImage.src = previewUrl;
        previewWrapper.style.display = 'block';
    });
});
</script>

@endsection
