@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')

<link rel="stylesheet" href="{{ secure_asset('css/admin/categories-edit.css') }}">

<div class="category-edit-page">

    <div class="category-page-header">

        <div>
            <span class="category-page-label">STORE MANAGEMENT</span>

            <h1>Edit Category</h1>

            <p>Update jewellery category information</p>
        </div>

        <a href="{{ route('admin.categories.index') }}" class="category-back-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Categories
        </a>

    </div>


    @if($errors->any())

        <div class="category-error">

            <i class="fa-solid fa-circle-exclamation"></i>

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


    <div class="category-edit-grid">

        <div class="category-form-card">

            <div class="category-card-header">

                <div class="category-header-icon">
                    <i class="fa-solid fa-layer-group"></i>
                </div>

                <div>
                    <h2>Category Information</h2>
                    <p>Update the details of this category</p>
                </div>

            </div>


            <form
                action="{{ route('admin.categories.update', $category->id) }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                <div class="category-form-group">

                    <label for="name">
                        Category Name
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $category->name) }}"
                        placeholder="Enter category name"
                        required
                    >

                    <small>
                        Example: Rings, Necklaces, Earrings
                    </small>

                </div>


                <div class="category-form-group">

                    <label for="status">
                        Status
                        <span>*</span>
                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                    >

                        <option
                            value="1"
                            {{ old('status', $category->status) == 1 ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="0"
                            {{ old('status', $category->status) == 0 ? 'selected' : '' }}
                        >
                            Inactive
                        </option>

                    </select>

                </div>


                <div class="category-information">

                    <div class="category-information-icon">
                        <i class="fa-solid fa-circle-info"></i>
                    </div>

                    <div>

                        <h4>Category Details</h4>

                        <p>
                            Category ID:
                            <strong>#{{ $category->id }}</strong>
                        </p>

                        <p>
                            Products:
                            <strong>
                                {{ $category->products_count ?? $category->products->count() }}
                            </strong>
                        </p>

                    </div>

                </div>


                <div class="category-form-actions">

                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="category-cancel-btn"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="category-update-btn"
                    >
                        <i class="fa-solid fa-floppy-disk"></i>
                        Update Category
                    </button>

                </div>

            </form>

        </div>


        <div class="category-preview-card">

            <div class="category-preview-header">

                <h2>Category Preview</h2>

                <p>Preview of your category</p>

            </div>


            <div class="category-preview-box">

                <div class="category-preview-icon">
                    <i class="fa-solid fa-gem"></i>
                </div>

                <div class="category-preview-content">

                    <span>CATEGORY</span>

                    <h3 id="categoryPreviewName">
                        {{ $category->name }}
                    </h3>

                    <div
                        id="categoryPreviewStatus"
                        class="category-preview-status {{ $category->status ? 'active' : 'inactive' }}"
                    >

                        <i class="fa-solid fa-circle"></i>

                        {{ $category->status ? 'Active' : 'Inactive' }}

                    </div>

                </div>

            </div>


            <div class="category-preview-line"></div>


            <div class="category-preview-stat">

                <div class="category-stat-icon">
                    <i class="fa-solid fa-box-open"></i>
                </div>

                <div>

                    <strong>
                        {{ $category->products_count ?? $category->products->count() }}
                    </strong>

                    <span>Products</span>

                </div>

            </div>


            <div class="category-preview-line"></div>


            <div class="category-preview-stat">

                <div class="category-stat-icon">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>

                <div>

                    <strong>
                        {{ $category->created_at->format('d M Y') }}
                    </strong>

                    <span>Created Date</span>

                </div>

            </div>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const nameInput = document.getElementById('name');

    const statusInput = document.getElementById('status');

    const previewName = document.getElementById('categoryPreviewName');

    const previewStatus = document.getElementById('categoryPreviewStatus');


    nameInput.addEventListener('input', function () {

        previewName.textContent =
            this.value.trim() || 'Category Name';

    });


    statusInput.addEventListener('change', function () {

        if (this.value == '1') {

            previewStatus.className =
                'category-preview-status active';

            previewStatus.innerHTML =
                '<i class="fa-solid fa-circle"></i> Active';

        } else {

            previewStatus.className =
                'category-preview-status inactive';

            previewStatus.innerHTML =
                '<i class="fa-solid fa-circle"></i> Inactive';

        }

    });

});

</script>

@endsection