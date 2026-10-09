<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();

        return view(
            'admin.blogs.index',
            compact('blogs')
        );
    }


    public function create()
    {
        return view('admin.blogs.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'author' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $validated['slug'] = Str::slug($request->title);


        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time() . '_' . $image->getClientOriginalName();

            $image->move(
                public_path('images/blog'),
                $imageName
            );

            $validated['image'] = $imageName;
        }


        Blog::create($validated);


        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog created successfully.');
    }


    public function edit(Blog $blog)
    {
        return view(
            'admin.blogs.edit',
            compact('blog')
        );
    }


    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'author' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $validated['slug'] = Str::slug($request->title);


        if ($request->hasFile('image')) {

            if (
                $blog->image &&
                file_exists(public_path('images/blog/' . $blog->image))
            ) {
                unlink(
                    public_path('images/blog/' . $blog->image)
                );
            }


            $image = $request->file('image');

            $imageName = time() . '_' . $image->getClientOriginalName();

            $image->move(
                public_path('images/blog'),
                $imageName
            );

            $validated['image'] = $imageName;
        }


        $blog->update($validated);


        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully.');
    }


    public function destroy(Blog $blog)
    {
        if (
            $blog->image &&
            file_exists(public_path('images/blog/' . $blog->image))
        ) {
            unlink(
                public_path('images/blog/' . $blog->image)
            );
        }


        $blog->delete();


        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog deleted successfully.');
    }
}