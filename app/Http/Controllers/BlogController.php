<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $featuredQuery = Blog::where('status', 1)->latest();

        $blogsQuery = Blog::where('status', 1)->latest();

        if ($request->filled('search')) {
            $featuredQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });

            $blogsQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $featuredPost = $featuredQuery->first();

        $blogs = $blogsQuery
            ->when(!$request->filled('search'), function ($query) {
                $query->skip(1);
            })
            ->take(4)
            ->get();

        $recentPosts = Blog::where('status', 1)
            ->latest()
            ->take(5)
            ->get();

        $categories = Blog::where('status', 1)
            ->select('category')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('category')
            ->get();

        return view('blog.index', compact(
            'featuredPost',
            'blogs',
            'recentPosts',
            'categories',
            'search'
        ));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $recentPosts = Blog::where('status', 1)
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(5)
            ->get();

        return view('blog.show', compact(
            'blog',
            'recentPosts'
        ));
    }
}

