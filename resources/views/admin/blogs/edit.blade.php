@extends('admin.layouts.app')

@section('title', 'Edit Blog | Admin')

@section('page-title', 'Edit Blog')

@section('content')

<div class="admin-page-header">

    <div>

        <h1>Edit Blog Post</h1>

        <p>Update your article</p>

    </div>

</div>


<div class="admin-panel">

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

            <div class="mb-3">

                <label>Title</label>

                <input
                    type="text"
                    name="title"
                    class="form-control"
                    value="{{ old('title', $blog->title) }}"
                    required
                >

            </div>


            <div class="mb-3">

                <label>Category</label>

                <input
                    type="text"
                    name="category"
                    class="form-control"
                    value="{{ old('category', $blog->category) }}"
                    required
                >

            </div>


            <div class="mb-3">

                <label>Excerpt</label>

                <textarea
                    name="excerpt"
                    class="form-control"
                    rows="4"
                >{{ old('excerpt', $blog->excerpt) }}</textarea>

            </div>


            <div class="mb-3">

                <label>Content</label>

                <textarea
                    name="content"
                    class="form-control"
                    rows="12"
                    required
                >{{ old('content', $blog->content) }}</textarea>

            </div>

        </div>

    </div>


    <div class="col-lg-4">

        <div class="form-section">

            <h4>Current Image</h4>

            @if($blog->image)

                <img
                    src="{{ asset('images/blog/' . $blog->image) }}"
                    class="edit-blog-image"
                    alt="{{ $blog->title }}"
                >

            @endif


            <input
                type="file"
                name="image"
                class="form-control mt-3"
                accept="image/*"
            >

        </div>


        <div class="form-section mt-4">

            <h4>Author</h4>

            <input
                type="text"
                name="author"
                class="form-control"
                value="{{ old('author', $blog->author) }}"
            >

        </div>


        <div class="form-section mt-4">

            <h4>Status</h4>

            <select
                name="status"
                class="form-select"
            >

                <option
                    value="1"
                    {{ $blog->status == 1 ? 'selected' : '' }}
                >
                    Published
                </option>

                <option
                    value="0"
                    {{ $blog->status == 0 ? 'selected' : '' }}
                >
                    Draft
                </option>

            </select>

        </div>


        <button
            type="submit"
            class="admin-btn w-100 mt-4"
        >
            <i class="fas fa-save"></i>
            Update Blog
        </button>

    </div>

</div>

</form>

</div>

@endsection