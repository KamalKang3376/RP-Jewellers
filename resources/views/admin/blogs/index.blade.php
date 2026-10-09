@extends('admin.layouts.app')

@section('title', 'Blog Posts')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/blogs.css') }}">

<div class="admin-blog-page">

    <div class="blog-page-header">

        <div>
            <span class="page-label">CONTENT MANAGEMENT</span>

            <h1>Blog Posts</h1>

            <p>Manage your jewellery articles</p>
        </div>

        <a href="{{ route('admin.blogs.create') }}" class="add-blog-btn">
            <i class="fa-solid fa-plus"></i>
            Add Blog
        </a>

    </div>


    @if(session('success'))

        <div class="blog-alert success">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="blog-alert error">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ session('error') }}
        </div>

    @endif


    <div class="blog-stats">

        <div class="blog-stat-card">

            <div class="stat-icon">
                <i class="fa-solid fa-newspaper"></i>
            </div>

            <div>
                <span>Total Posts</span>
                <strong>{{ $blogs->count() }}</strong>
            </div>

        </div>


        <div class="blog-stat-card">

            <div class="stat-icon published">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <div>
                <span>Published</span>
                <strong>
                    {{ $blogs->where('status', 1)->count() }}
                </strong>
            </div>

        </div>


        <div class="blog-stat-card">

            <div class="stat-icon draft">
                <i class="fa-solid fa-file"></i>
            </div>

            <div>
                <span>Drafts</span>
                <strong>
                    {{ $blogs->where('status', 0)->count() }}
                </strong>
            </div>

        </div>

    </div>


    <div class="blog-card">

        <div class="blog-card-header">

            <div>
                <h2>All Blog Posts</h2>
                <p>View and manage your jewellery articles</p>
            </div>

            <div class="blog-search">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    id="blogSearch"
                    placeholder="Search blogs..."
                >

            </div>

        </div>


        <div class="blog-table-wrapper">

            <table class="blog-table">

                <thead>

                    <tr>

                        <th>Image</th>

                        <th>Title</th>

                        <th>Category</th>

                        <th>Author</th>

                        <th>Status</th>

                        <th>Action</th>

                    </tr>

                </thead>


                <tbody id="blogTableBody">

                    @forelse($blogs as $blog)

                        <tr>

                            <td>

                                <div class="blog-image">

                                    @if($blog->image)

                                        <img
                                            src="{{ asset('images/blogs/' . $blog->image) }}"
                                            alt="{{ $blog->title }}"
                                        >

                                    @else

                                        <div class="no-blog-image">
                                            <i class="fa-solid fa-image"></i>
                                        </div>

                                    @endif

                                </div>

                            </td>


                            <td>

                                <div class="blog-title">

                                    <strong>
                                        {{ $blog->title }}
                                    </strong>

                                    @if($blog->slug)

                                        <span>
                                            /{{ $blog->slug }}
                                        </span>

                                    @endif

                                </div>

                            </td>


                            <td>

                                <span class="category-badge">

                                    {{ $blog->category->name ?? 'Uncategorized' }}

                                </span>

                            </td>


                            <td>

                                <div class="author">

                                    <div class="author-avatar">
                                        <i class="fa-solid fa-user"></i>
                                    </div>

                                    <span>
                                        {{ $blog->author->name ?? 'Admin' }}
                                    </span>

                                </div>

                            </td>


                            <td>

                                @if($blog->status)

                                    <span class="status-badge active">
                                        <span></span>
                                        Published
                                    </span>

                                @else

                                    <span class="status-badge inactive">
                                        <span></span>
                                        Draft
                                    </span>

                                @endif

                            </td>


                            <td>

                                <div class="action-buttons">

                                    <a
                                        href="{{ route('admin.blogs.edit', $blog->id) }}"
                                        class="action-btn edit"
                                        title="Edit Blog"
                                    >
                                        <i class="fa-solid fa-pen"></i>
                                    </a>


                                    <form
                                        action="{{ route('admin.blogs.destroy', $blog->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this blog?')"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action-btn delete"
                                            title="Delete Blog"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr class="empty-row">

                            <td colspan="6">

                                <div class="empty-blog">

                                    <div class="empty-icon">
                                        <i class="fa-solid fa-newspaper"></i>
                                    </div>

                                    <h3>No Blog Posts Found</h3>

                                    <p>
                                        You haven't created any blog posts yet.
                                    </p>

                                    <a
                                        href="{{ route('admin.blogs.create') }}"
                                        class="empty-add-btn"
                                    >
                                        <i class="fa-solid fa-plus"></i>
                                        Create Your First Blog
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


<script>

document.getElementById('blogSearch').addEventListener('keyup', function() {

    const searchValue = this.value.toLowerCase();

    const rows = document.querySelectorAll(
        '#blogTableBody tr:not(.empty-row)'
    );

    rows.forEach(function(row) {

        const text = row.textContent.toLowerCase();

        if (text.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }

    });

});

</script>

@endsection