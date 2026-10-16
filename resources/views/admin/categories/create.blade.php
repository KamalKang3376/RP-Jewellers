@extends('admin.layouts.app')

@section('title', 'Create Category')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin/categories-create.css') }}">
@endpush

@section('content')

<div class="category-create-page">

    <div class="page-header">

        <div>
            <span class="page-label">STORE MANAGEMENT</span>

            <h1>Create Category</h1>

            <p>Add a new jewellery category to your store</p>
        </div>

        <a
            href="{{ route('admin.categories.index') }}"
            class="back-btn"
        >
            <i class="fa-solid fa-arrow-left"></i>
            Back to Categories
        </a>

    </div>


    @if($errors->any())

        <div class="validation-alert">

            <div class="alert-icon">
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


    <div class="category-layout">


        <div class="category-form-card">

            <div class="card-heading">

                <div class="heading-icon">
                    <i class="fa-solid fa-layer-group"></i>
                </div>

                <div>

                    <h2>Category Information</h2>

                    <p>
                        Enter the details for your new jewellery category
                    </p>

                </div>

            </div>


            <form
                action="{{ route('admin.categories.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                <div class="form-group">

                    <label for="name">
                        Category Name
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter category name"
                        required
                    >

                    <small>
                        Example: Rings, Necklaces, Earrings
                    </small>

                </div>


                <div class="form-group">

                    <label for="image">
                        Category Image
                    </label>

                    <div class="image-upload-box">

                        <div class="upload-icon">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                        </div>

                        <div class="upload-content">

                            <strong>
                                Upload Category Image
                            </strong>

                            <span>
                                JPG, JPEG, PNG or WEBP
                            </span>

                            <small>
                                Maximum file size: 2MB
                            </small>

                        </div>

                        <label
                            for="image"
                            class="choose-image-btn"
                        >
                            Choose Image
                        </label>

                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept="image/jpeg,image/png,image/webp"
                        >

                    </div>


                    <div
                        class="image-preview-wrapper"
                        id="imagePreviewWrapper"
                    >

                        <img
                            id="imagePreview"
                            src=""
                            alt="Category Preview"
                        >

                        <button
                            type="button"
                            id="removeImage"
                            class="remove-image-btn"
                        >
                            <i class="fa-solid fa-xmark"></i>
                        </button>

                    </div>

                </div>


                <div class="form-group">

                    <label for="status">

                        Status

                        <span>*</span>

                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                    >

                        <option value="1"
                            {{ old('status', 1) == 1 ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option value="0"
                            {{ old('status') == 0 ? 'selected' : '' }}
                        >
                            Inactive
                        </option>

                    </select>

                </div>


                <div class="category-info-box">

                    <div class="info-icon">

                        <i class="fa-solid fa-circle-info"></i>

                    </div>

                    <div>

                        <strong>
                            Category Details
                        </strong>

                        <p>
                            A unique slug will be automatically created
                            from the category name.
                        </p>

                        <p>
                            You can change the category status anytime
                            from the edit page.
                        </p>

                    </div>

                </div>


                <div class="form-actions">

                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="cancel-btn"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="create-btn"
                    >
                        <i class="fa-solid fa-plus"></i>
                        Create Category
                    </button>

                </div>

            </form>

        </div>


        <div class="category-preview-card">

            <div class="preview-heading">

                <h2>Category Preview</h2>

                <p>
                    Preview how your category information looks
                </p>

            </div>


            <div class="category-preview-image">

                <div
                    class="preview-image-placeholder"
                    id="previewImagePlaceholder"
                >

                    <i class="fa-solid fa-gem"></i>

                </div>

                <img
                    src=""
                    alt="Category Preview"
                    id="categoryPreviewImage"
                >

            </div>


            <div class="category-preview">

                <div class="preview-icon">

                    <i class="fa-solid fa-layer-group"></i>

                </div>


                <div class="preview-details">

                    <span class="preview-label">
                        CATEGORY
                    </span>

                    <h3 id="categoryPreviewName">
                        Category Name
                    </h3>

                    <span
                        class="preview-status active"
                        id="categoryPreviewStatus"
                    >

                        <i class="fa-solid fa-circle"></i>

                        Active

                    </span>

                </div>

            </div>


            <div class="preview-divider"></div>


            <div class="category-stat">

                <div class="stat-icon">

                    <i class="fa-solid fa-box-open"></i>

                </div>

                <div>

                    <strong>
                        0
                    </strong>

                    <span>
                        Products
                    </span>

                </div>

            </div>


            <div class="preview-divider"></div>


            <div class="category-stat">

                <div class="stat-icon">

                    <i class="fa-solid fa-plus"></i>

                </div>

                <div>

                    <strong>
                        New
                    </strong>

                    <span>
                        Category
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const nameInput =
        document.getElementById('name');

    const statusInput =
        document.getElementById('status');

    const imageInput =
        document.getElementById('image');

    const previewName =
        document.getElementById('categoryPreviewName');

    const previewStatus =
        document.getElementById('categoryPreviewStatus');

    const imagePreviewWrapper =
        document.getElementById('imagePreviewWrapper');

    const imagePreview =
        document.getElementById('imagePreview');

    const categoryPreviewImage =
        document.getElementById('categoryPreviewImage');

    const previewImagePlaceholder =
        document.getElementById('previewImagePlaceholder');

    const removeImage =
        document.getElementById('removeImage');


    nameInput.addEventListener('input', function () {

        previewName.textContent =
            this.value.trim() || 'Category Name';

    });


    statusInput.addEventListener('change', function () {

        if (this.value === '1') {

            previewStatus.className =
                'preview-status active';

            previewStatus.innerHTML =
                '<i class="fa-solid fa-circle"></i> Active';

        } else {

            previewStatus.className =
                'preview-status inactive';

            previewStatus.innerHTML =
                '<i class="fa-solid fa-circle"></i> Inactive';

        }

    });


    imageInput.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) {
            return;
        }

        if (!file.type.startsWith('image/')) {

            alert('Please select a valid image.');

            imageInput.value = '';

            return;
        }


        const reader = new FileReader();


        reader.onload = function (event) {

            imagePreview.src =
                event.target.result;

            categoryPreviewImage.src =
                event.target.result;

            imagePreviewWrapper.classList.add('show');

            categoryPreviewImage.classList.add('show');

            previewImagePlaceholder.classList.add('hide');

        };


        reader.readAsDataURL(file);

    });


    removeImage.addEventListener('click', function () {

        imageInput.value = '';

        imagePreview.src = '';

        categoryPreviewImage.src = '';

        imagePreviewWrapper.classList.remove('show');

        categoryPreviewImage.classList.remove('show');

        previewImagePlaceholder.classList.remove('hide');

    });

});

</script>

@endpush