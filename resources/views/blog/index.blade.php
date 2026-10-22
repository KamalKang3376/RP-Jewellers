
@extends('layouts.app')

@section('title', 'Blog | RP Jewellers')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/blog.css') }}">
@endpush

@section('content')

<section class="blog-banner">
    <div class="blog-banner-overlay">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <span>/</span>
                <span class="active">Blog</span>
            </div>

            <h1>Our Blog</h1>

            <p>
                Jewellery tips, trends, and timeless stories.<br>
                Stay inspired with our latest articles.
            </p>
        </div>
    </div>
</section>

<section class="blog-section">
    <div class="container">
        <div class="row g-4">

            <div class="col-lg-8">
                <div class="row g-4">

                    @if($featuredPost)
                        <div class="col-12">
                            <article class="featured-blog">

                                <div class="featured-image">
                                    @if($featuredPost->image)
                                        <img
                                            src="{{ asset('storage/' . ltrim($featuredPost->image, '/')) }}"
                                            alt="{{ $featuredPost->title }}"
                                            onerror="this.onerror=null; this.style.display='none';"
                                        >
                                    @endif
                                </div>

                                <div class="featured-content">
                                    <span class="blog-category">
                                        {{ $featuredPost->category }}
                                    </span>

                                    <h2>{{ $featuredPost->title }}</h2>

                                    <p>{{ $featuredPost->excerpt }}</p>

                                    <div class="blog-meta">
                                        <span>
                                            <i class="far fa-calendar"></i>
                                            {{ $featuredPost->created_at->format('M d, Y') }}
                                        </span>

                                        <span>
                                            <i class="far fa-comment"></i>
                                            3 Comments
                                        </span>
                                    </div>

                                    <a
                                        href="{{ route('blog.show', $featuredPost->slug) }}"
                                        class="read-more"
                                    >
                                        Read More
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>

                            </article>
                        </div>
                    @endif

                    @forelse($blogs as $blog)
                        <div class="col-md-6">
                            <article class="blog-card">

                                <div class="blog-image">
                                    @if($blog->image)
                                        <img
                                            src="{{ asset('storage/' . ltrim($blog->image, '/')) }}"
                                            alt="{{ $blog->title }}"
                                            onerror="this.onerror=null; this.style.display='none';"
                                        >
                                    @endif
                                </div>

                                <div class="blog-card-content">
                                    <span class="blog-category">
                                        {{ $blog->category }}
                                    </span>

                                    <h3>{{ $blog->title }}</h3>

                                    <p>{{ $blog->excerpt }}</p>

                                    <div class="blog-meta">
                                        <span>
                                            <i class="far fa-calendar"></i>
                                            {{ $blog->created_at->format('M d, Y') }}
                                        </span>

                                        <span>
                                            <i class="far fa-comment"></i>
                                            2 Comments
                                        </span>
                                    </div>

                                    <a
                                        href="{{ route('blog.show', $blog->slug) }}"
                                        class="small-read-more"
                                    >
                                        Read More
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>

                            </article>
                        </div>
                    @empty
                        @if(!$featuredPost)
                            <div class="col-12">
                                <p>No blog posts found.</p>
                            </div>
                        @endif
                    @endforelse

                </div>
            </div>

            <div class="col-lg-4">
                <aside class="blog-sidebar">

                    <div class="sidebar-box">
                        <h4>Search Blog</h4>

                        <form action="{{ route('blog') }}" method="GET">
                            <div class="blog-search">
                                <input
                                    type="text"
                                    name="search"
                                    placeholder="Search articles..."
                                    value="{{ request('search') }}"
                                >

                                <button type="submit" aria-label="Search blog">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="sidebar-box">
                        <h4>Categories</h4>

                        <ul class="category-list">
                            @foreach($categories as $category)
                                <li>
                                    <a href="#">
                                        <span>
                                            <i class="fas fa-chevron-right"></i>
                                            {{ $category->category }}
                                        </span>

                                        <small>({{ $category->total }})</small>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="sidebar-box">
                        <h4>Recent Posts</h4>

                        <div class="recent-posts">
                            @foreach($recentPosts as $post)
                                <a
                                    href="{{ route('blog.show', $post->slug) }}"
                                    class="recent-post"
                                >
                                    @if($post->image)
                                        <img
                                            src="{{ asset('storage/' . ltrim($post->image, '/')) }}"
                                            alt="{{ $post->title }}"
                                            onerror="this.onerror=null; this.style.display='none';"
                                        >
                                    @endif

                                    <div>
                                        <h5>{{ $post->title }}</h5>

                                        <span>
                                            {{ $post->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </aside>
            </div>

        </div>
    </div>
</section>

@endsection
