@extends('admin.layouts.app')

@section('title', 'Categories')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/categories.css') }}">
@endpush

@section('content')

<div class="categories-page">

    <div class="page-header">

        <div class="page-header-content">

            <span class="page-label">STORE MANAGEMENT</span>

            <h1>Categories</h1>

            <p>Manage your jewellery categories</p>

        </div>

        <a
            href="{{ route('admin.categories.create') }}"
            class="add-category-btn"
        >
            <i class="fa-solid fa-plus"></i>
            Add Category
        </a>

    </div>


    @if(session('success'))

        <div class="success-alert">

            <i class="fa-solid fa-circle-check"></i>

            <span>{{ session('success') }}</span>

        </div>

    @endif


    @if(session('error'))

        <div class="error-alert">

            <i class="fa-solid fa-circle-exclamation"></i>

            <span>{{ session('error') }}</span>

        </div>

    @endif


    <div class="categories-card">

        <div class="card-top">

            <div>

                <h2>All Categories</h2>

                <p>
                    {{ $categories->count() }}
                    {{ $categories->count() == 1 ? 'category' : 'categories' }}
                    available
                </p>

            </div>

            <div class="category-count">

                <i class="fa-solid fa-layer-group"></i>

                <span>{{ $categories->count() }}</span>

            </div>

        </div>


        @if($categories->count() > 0)

            <div class="table-wrapper">

                <table class="categories-table">

                    <thead>

                        <tr>

                            <th class="number-column">#</th>

                            <th>Name</th>

                            <th>Products</th>

                            <th>Status</th>

                            <th class="action-column">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($categories as $index => $category)

                            <tr>

                                <td
                                    class="number-column"
                                    data-label="#"
                                >
                                    {{ $index + 1 }}
                                </td>


                                <td
                                    class="category-name"
                                    data-label="Name"
                                >

                                    <div class="category-name-wrapper">

                                        <div class="category-icon">

                                            <i class="fa-solid fa-gem"></i>

                                        </div>

                                        <div>

                                            <strong>
                                                {{ $category->name }}
                                            </strong>

                                            <small>
                                                {{ $category->slug }}
                                            </small>

                                        </div>

                                    </div>

                                </td>


                                <td
                                    data-label="Products"
                                    class="products-count"
                                >

                                    <span>
                                        {{ $category->products_count ?? $category->products->count() }}
                                    </span>

                                </td>


                                <td
                                    data-label="Status"
                                    class="status-column"
                                >

                                    @if($category->status)

                                        <span class="status-badge active">
                                            <i class="fa-solid fa-circle"></i>
                                            Active
                                        </span>

                                    @else

                                        <span class="status-badge inactive">
                                            <i class="fa-solid fa-circle"></i>
                                            Inactive
                                        </span>

                                    @endif

                                </td>


                                <td
                                    data-label="Action"
                                    class="action-column"
                                >

                                    <div class="action-buttons">

                                        <a
                                            href="{{ route('admin.categories.edit', $category->id) }}"
                                            class="edit-btn"
                                            title="Edit Category"
                                        >
                                            <i class="fa-solid fa-pen"></i>
                                        </a>


                                        <form
                                            action="{{ route('admin.categories.destroy', $category->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this category?');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="delete-btn"
                                                title="Delete Category"
                                            >
                                                <i class="fa-solid fa-trash"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="empty-state">

                <div class="empty-icon">

                    <i class="fa-solid fa-layer-group"></i>

                </div>

                <h3>No Categories Found</h3>

                <p>
                    You haven't created any jewellery categories yet.
                </p>

                <a
                    href="{{ route('admin.categories.create') }}"
                    class="empty-add-btn"
                >
                    <i class="fa-solid fa-plus"></i>
                    Add Your First Category
                </a>

            </div>

        @endif

    </div>

</div>

@endsection