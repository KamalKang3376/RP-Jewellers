<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    protected CloudinaryService $cloudinary;

    public function __construct(CloudinaryService $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }

    public function index()
    {
        $blogs = Blog::latest()->get();

        return view('admin.blogs.index', compact('blogs'));
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

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $uploadedImage = $this->cloudinary->upload(
                $request->file('image'),
                'rp-jewellers/blogs'
            );

            $validated['image'] = $uploadedImage['url'];
            $validated['cloudinary_public_id'] = $uploadedImage['public_id'];
        }

        Blog::create($validated);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
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

        $validated['slug'] = Str::slug($validated['title']);

        $oldImage = $blog->image;
        $oldPublicId = $blog->cloudinary_public_id;

        if ($request->hasFile('image')) {
            $uploadedImage = $this->cloudinary->upload(
                $request->file('image'),
                'rp-jewellers/blogs'
            );

            $validated['image'] = $uploadedImage['url'];
            $validated['cloudinary_public_id'] = $uploadedImage['public_id'];
        }

        $blog->update($validated);

        if ($request->hasFile('image')) {
            $this->deleteBlogImage($oldImage, $oldPublicId);
        }

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $image = $blog->image;
        $publicId = $blog->cloudinary_public_id;

        $blog->delete();

        $this->deleteBlogImage($image, $publicId);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog deleted successfully.');
    }

    private function deleteBlogImage(
        ?string $image,
        ?string $publicId
    ): void {
        if ($publicId) {
            $this->cloudinary->delete($publicId);

            return;
        }

        if ($image && str_starts_with($image, 'blogs/')) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($image);
        }
    }
}
