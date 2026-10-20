@extends('admin.layouts.app')

@section('title', 'Create Blog Post')

@section('content')

<link rel="stylesheet" href="{{ secure_asset('css/admin/blog-create.css') }}">

<div class="blog-create-page">

    <div class="blog-create-header">

        <div>
            <span class="page-label">CONTENT MANAGEMENT</span>

            <h1>Create Blog Post</h1>

            <p>Write a new jewellery article</p>
        </div>

        <a href="{{ route('admin.blogs.index') }}" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Blogs
        </a>

    </div>


    @if($errors->any())

        <div class="blog-error">

            <div class="error-icon">
                <i class="fa-solid fa-circle-exclamation"></i>
            </div>

            <div>

                <strong>Please fix the following errors:</strong>

                <ul>

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    <form
        action="{{ route('admin.blogs.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        <div class="blog-create-grid">

            <div class="blog-main-card">

                <div class="card-heading">

                    <div class="heading-icon">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>

                    <div>
                        <h2>Article Information</h2>
                        <p>Create the content of your jewellery article</p>
                    </div>

                </div>


                <div class="form-group">

                    <label for="title">
                        Blog Title
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Enter blog post title"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="category">
                        Category
                        <span>*</span>
                    </label>

                    <div class="input-with-icon">

                        <i class="fa-solid fa-layer-group"></i>

                        <input
                            type="text"
                            id="category"
                            name="category"
                            value="{{ old('category', 'Jewellery Guide') }}"
                            placeholder="Enter category"
                            required
                        >

                    </div>

                </div>


                <div class="form-group">

                    <label for="excerpt">
                        Short Description
                    </label>

                    <textarea
                        id="excerpt"
                        name="excerpt"
                        rows="4"
                        placeholder="Write a short description for your article..."
                    >{{ old('excerpt') }}</textarea>

                    <small>
                        A short summary that will appear on the blog listing.
                    </small>

                </div>


                <div class="form-group content-group">

                    <label for="content">
                        Article Content
                        <span>*</span>
                    </label>

                    <textarea
                        id="content"
                        name="content"
                        rows="12"
                        placeholder="Write your jewellery article here..."
                        required
                    >{{ old('content') }}</textarea>

                </div>

            </div>


            <div class="blog-side-column">

                <div class="blog-side-card">

                    <div class="side-card-title">

                        <i class="fa-solid fa-image"></i>

                        <div>
                            <h3>Featured Image</h3>
                            <p>Upload article image</p>
                        </div>

                    </div>


                    <div class="image-upload">

                        <div class="image-preview" id="imagePreview">

                            <div class="preview-placeholder">

                                <i class="fa-solid fa-cloud-arrow-up"></i>

                                <span>Upload Image</span>

                                <small>JPG, PNG, WEBP</small>

                            </div>

                        </div>


                        <label for="image" class="choose-image-btn">

                            <i class="fa-solid fa-folder-open"></i>

                            Choose Image

                        </label>

                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept=".jpg,.jpeg,.png,.webp"
                            hidden
                        >

                        <p class="upload-note">
                            Maximum file size: 2MB
                        </p>

                    </div>

                </div>


                <div class="blog-side-card">

                    <div class="side-card-title">

                        <i class="fa-solid fa-user-pen"></i>

                        <div>
                            <h3>Author</h3>
                            <p>Article author</p>
                        </div>

                    </div>


                    <div class="form-group side-form-group">

                        <label for="author">
                            Author Name
                        </label>

                        <div class="input-with-icon">

                            <i class="fa-solid fa-user"></i>

                            <input
                                type="text"
                                id="author"
                                name="author"
                                value="{{ old('author', 'Admin') }}"
                                placeholder="Enter author name"
                            >

                        </div>

                    </div>

                </div>


                <div class="blog-side-card">

                    <div class="side-card-title">

                        <i class="fa-solid fa-toggle-on"></i>

                        <div>
                            <h3>Publishing</h3>
                            <p>Choose article status</p>
                        </div>

                    </div>


                    <div class="form-group side-form-group">

                        <label for="status">
                            Status
                        </label>

                        <select id="status" name="status">
                            <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>
                                Published
                            </option>

                            <option value="0" {{ old('status', '1') == '0' ? 'selected' : '' }}>
                                Draft
                            </option>
                        </select>

                            <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>
                                Published
                            </option>

                            <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>
                                Draft
                            </option>

                        </select>

                    </div>

                </div>


                <button
                    type="submit"
                    class="publish-btn"
                >

                    <i class="fa-solid fa-paper-plane"></i>

                    Publish Blog

                </button>


                <a
                    href="{{ route('admin.blogs.index') }}"
                    class="cancel-btn"
                >
                    Cancel
                </a>

            </div>

        </div>

    </form>

</div>


<script>
document.getElementById('image').addEventListener('change', function (event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');

    if (!file) {
        return;
    }

    const reader = new FileReader();

    reader.onload = function (e) {
        preview.innerHTML = `
            <img src="${e.target.result}" alt="Image Preview">
        `;
    };

    reader.readAsDataURL(file);
});
</script>
@endsection