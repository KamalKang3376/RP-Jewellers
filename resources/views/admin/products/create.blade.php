@extends('admin.layouts.app')

@section('title', 'Add Product')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin/products-create.css') }}">
@endpush

@section('content')

<div class="product-create-page">

    <div class="create-header">

        <div>
            <span class="page-label">STORE MANAGEMENT</span>

            <h1>Add Product</h1>

            <p>Create a new jewellery product</p>
        </div>

        <a
            href="{{ route('admin.products.index') }}"
            class="back-btn"
        >
            <i class="fa-solid fa-arrow-left"></i>
            Back to Products
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


    <form action="{{ secure_url(route('admin.products.store', [], false)) }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="create-grid">

            <div class="form-card">

                <div class="card-heading">

                    <div class="heading-icon">
                        <i class="fa-solid fa-gem"></i>
                    </div>

                    <div>
                        <h2>Product Information</h2>
                        <p>Enter the basic details of your jewellery product</p>
                    </div>

                </div>


                <div class="form-group">

                    <label for="name">
                        Product Name
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter product name"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="description">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="7"
                        placeholder="Write a description for your jewellery product..."
                    >{{ old('description') }}</textarea>

                </div>


                <div class="two-column">

                    <div class="form-group">

                        <label for="price">
                            Price
                            <span>*</span>
                        </label>

                        <div class="input-with-icon">

                            <span>₹</span>

                            <input
                                type="number"
                                id="price"
                                name="price"
                                value="{{ old('price') }}"
                                placeholder="0.00"
                                min="0"
                                step="0.01"
                                required
                            >

                        </div>

                    </div>


                    <div class="form-group">

                        <label for="discount_price">
                            Discount Price
                        </label>

                        <div class="input-with-icon">

                            <span>₹</span>

                            <input
                                type="number"
                                id="discount_price"
                                name="discount_price"
                                value="{{ old('discount_price') }}"
                                placeholder="0.00"
                                min="0"
                                step="0.01"
                            >

                        </div>

                    </div>

                </div>


                <div class="two-column">

                    <div class="form-group">

                        <label for="stock">
                            Stock
                            <span>*</span>
                        </label>

                        <input
                            type="number"
                            id="stock"
                            name="stock"
                            value="{{ old('stock', 0) }}"
                            min="0"
                            placeholder="0"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="status">
                            Status
                            <span>*</span>
                        </label>

                       <select id="status" name="status" required>
                            <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0" {{ old('status', '1') == '0' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select> 

                    </div>

                </div>

            </div>


            <div class="side-column">

                <div class="form-card">

                    <div class="card-heading">

                        <div class="heading-icon">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>

                        <div>
                            <h2>Category</h2>
                            <p>Select product category</p>
                        </div>

                    </div>


                    <div class="form-group">

                        <label for="category_id">
                            Product Category
                            <span>*</span>
                        </label>

                        <select id="category_id" name="category_id" required>
                            <option value="">Select Category</option>

                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                </div>


                <div class="form-card image-card">

                    <div class="card-heading">

                        <div class="heading-icon">
                            <i class="fa-regular fa-image"></i>
                        </div>

                        <div>
                            <h2>Product Image</h2>
                            <p>Upload product image</p>
                        </div>

                    </div>


                    <div class="image-upload">

                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <label for="image" class="upload-area">

                            <div
                                class="image-preview"
                                id="imagePreview"
                            >

                                <i class="fa-solid fa-cloud-arrow-up"></i>

                            </div>

                            <strong>
                                Click to upload image
                            </strong>

                            <span>
                                JPG, JPEG, PNG or WEBP
                            </span>

                            <small>
                                Maximum size: 2MB
                            </small>

                        </label>

                    </div>

                </div>


                <div class="save-card">

                    <button
                        type="submit"
                        class="save-btn"
                    >
                        <i class="fa-solid fa-floppy-disk"></i>
                        Save Product
                    </button>

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="cancel-btn"
                    >
                        Cancel
                    </a>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection



@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');

    if (!imageInput || !imagePreview) {
        return;
    }

    imageInput.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) {
            imagePreview.innerHTML =
                '<i class="fa-solid fa-cloud-arrow-up"></i>';
            return;
        }

        if (!file.type.startsWith('image/')) {
            imageInput.value = '';
            imagePreview.innerHTML =
                '<i class="fa-solid fa-cloud-arrow-up"></i>';
            alert('Please select a valid image.');
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {
            imagePreview.innerHTML =
                '<img src="' + event.target.result +
                '" alt="Product Preview">';
        };

        reader.readAsDataURL(file);
    });
});
</script>
@endpush
