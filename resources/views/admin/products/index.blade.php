@extends('admin.layouts.app')

@section('title', 'Products')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin/products.css') }}">
@endpush

@section('content')

<div class="products-page">

    <div class="products-header">

        <div>
            <span class="page-label">STORE MANAGEMENT</span>

            <h1>Products</h1>

            <p>Manage your jewellery products</p>
        </div>

        <a
            href="{{ route('admin.products.create') }}"
            class="add-product-btn"
        >
            <i class="fa-solid fa-plus"></i>
            Add Product
        </a>

    </div>


    <div class="products-card">

        <div class="products-card-top">

            <div>
                <h3>All Products</h3>

                <span>
                    {{ $products->count() }} products
                </span>
            </div>


            <div class="product-search">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    id="productSearch"
                    placeholder="Search products..."
                >

            </div>

        </div>


        <div class="table-wrapper">

            <table class="products-table">

                <thead>

                    <tr>

                        <th>Product</th>

                        <th>Category</th>

                        <th>Price</th>

                        <th>Stock</th>

                        <th>Status</th>

                        <th>Actions</th>

                    </tr>

                </thead>


                <tbody id="productsTable">

                    @forelse($products as $product)

                    <tr>

                        <td>

                            <div class="product-info">

                                <div class="product-image">

                                  
                            @if($product->image)
                                <img
                                    src="{{ str_starts_with($product->image, 'products/')
                                        ? asset('storage/' . $product->image)
                                        : asset('images/products/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                >

                                <div class="no-image" style="display: none;">
                                    <i class="fa-regular fa-image"></i>
                                </div>
                            @else
                                <div class="no-image">
                                    <i class="fa-regular fa-image"></i>
                                </div>
                            @endif
                            

                                </div>


                                <div class="product-details">

                                    <h4>
                                        {{ $product->name }}
                                    </h4>

                                    <span>
                                        Product #{{ $product->id }}
                                    </span>

                                </div>

                            </div>

                        </td>


                        <td>

                            <span class="category-name">

                                {{ $product->category->name ?? 'Uncategorized' }}

                            </span>

                        </td>


                        <td>

                            <div class="price-box">

                                @if($product->discount_price)

                                    <strong>
                                        ₹{{ number_format($product->discount_price, 2) }}
                                    </strong>

                                    <del>
                                        ₹{{ number_format($product->price, 2) }}
                                    </del>

                                @else

                                    <strong>
                                        ₹{{ number_format($product->price, 2) }}
                                    </strong>

                                @endif

                            </div>

                        </td>


                        <td>

                            @if($product->stock > 10)

                                <span class="stock-badge stock-good">
                                    {{ $product->stock }} in stock
                                </span>

                            @elseif($product->stock > 0)

                                <span class="stock-badge stock-low">
                                    {{ $product->stock }} left
                                </span>

                            @else

                                <span class="stock-badge stock-out">
                                    Out of stock
                                </span>

                            @endif

                        </td>


                        <td>

                            @if($product->status)

                                <span class="status-badge status-active">

                                    <span></span>

                                    Active

                                </span>

                            @else

                                <span class="status-badge status-inactive">

                                    <span></span>

                                    Inactive

                                </span>

                            @endif

                        </td>


                        <td>

                            <div class="action-buttons">

                                <a
                                    href="{{ route('admin.products.edit', $product->id) }}"
                                    class="action-btn edit-btn"
                                    title="Edit Product"
                                >

                                    <i class="fa-solid fa-pen"></i>

                                </a>


                                <a
                                    href="{{ route('product.show', $product->slug) }}"
                                    class="action-btn view-btn"
                                    title="View Product"
                                    target="_blank"
                                >

                                    <i class="fa-solid fa-eye"></i>

                                </a>


                                <form
                                    action="{{ route('admin.products.destroy', $product->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this product?');"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="action-btn delete-btn"
                                        title="Delete Product"
                                    >

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6">

                            <div class="empty-products">

                                <div class="empty-icon">

                                    <i class="fa-regular fa-gem"></i>

                                </div>


                                <h3>
                                    No Products Found
                                </h3>


                                <p>
                                    Start adding jewellery products to your store.
                                </p>


                                <a
                                    href="{{ route('admin.products.create') }}"
                                >

                                    <i class="fa-solid fa-plus"></i>

                                    Add Your First Product

                                </a>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('productSearch');

    const rows = document.querySelectorAll('#productsTable tr');


    if (searchInput) {

        searchInput.addEventListener('keyup', function () {

            const searchValue = this.value.toLowerCase().trim();


            rows.forEach(function (row) {

                const rowText = row.textContent.toLowerCase();

                if (rowText.includes(searchValue)) {

                    row.style.display = '';

                } else {

                    row.style.display = 'none';

                }

            });

        });

    }

});

</script>

@endpush