<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class CategoryController extends Controller
{
    public function __construct(
        private CloudinaryService $cloudinary
    ) {}

    public function index()
    {
        $categories = Category::withCount('products')
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            try {
                $uploadedImage = $this->cloudinary->upload(
                    $request->file('image'),
                    'rp-jewellers/categories'
                );

                $validated['image'] = $uploadedImage['url'];
                $validated['cloudinary_public_id'] = $uploadedImage['public_id'];
            } catch (Throwable $e) {
                Log::error('Category image upload failed: ' . $e->getMessage());

                return back()
                    ->withInput()
                    ->with('error', 'Unable to upload category image. Please try again.');
            }
        }

        Category::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category added successfully.');
    }

    public function show(Category $category)
    {
        $category->load('products');

        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $category->loadCount('products');

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:categories,name,' . $category->id,
            ],
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            try {
                $uploadedImage = $this->cloudinary->upload(
                    $request->file('image'),
                    'rp-jewellers/categories'
                );
            } catch (Throwable $e) {
                Log::error('Category image upload failed: ' . $e->getMessage());

                return back()
                    ->withInput()
                    ->with('error', 'Unable to upload category image. Please try again.');
            }

            $oldImage = $category->image;
            $oldPublicId = $category->cloudinary_public_id;

            $validated['image'] = $uploadedImage['url'];
            $validated['cloudinary_public_id'] = $uploadedImage['public_id'];

            $category->update($validated);

            $this->deletePreviousImage($oldPublicId, $oldImage);

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Category updated successfully.');
        }

        $category->update($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'This category cannot be deleted because it has products.');
        }

        $this->deletePreviousImage(
            $category->cloudinary_public_id,
            $category->image
        );

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    private function deletePreviousImage(
        ?string $publicId,
        ?string $image
    ): void {
        try {
            if ($publicId) {
                $this->cloudinary->delete($publicId);
            } elseif ($image && !filter_var($image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete('categories/' . $image);
            }
        } catch (Throwable $e) {
            Log::warning('Unable to delete previous category image: ' . $e->getMessage());
        }
    }
}
