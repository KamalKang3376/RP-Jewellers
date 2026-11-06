<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected CloudinaryService $cloudinary;

    public function __construct(CloudinaryService $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }

    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'stock' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        // Generate a unique slug before uploading the image.
        $validated['slug'] = $this->generateUniqueSlug(
            $validated['name']
        );

        if ($request->hasFile('image')) {
            $uploadedImage = $this->cloudinary->upload(
                $request->file('image'),
                'rp-jewellers/products'
            );

            $validated['image'] = $uploadedImage['url'];
            $validated['cloudinary_public_id'] = $uploadedImage['public_id'];
        }

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product added successfully.');
    }

    public function show(Product $product)
    {
        $product->load('category');

        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();

        return view(
            'admin.products.edit',
            compact('product', 'categories')
        );
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'stock' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        // Generate a unique slug while excluding the current product.
        $validated['slug'] = $this->generateUniqueSlug(
            $validated['name'],
            $product->id
        );

        $oldImage = $product->image;
        $oldPublicId = $product->cloudinary_public_id;

        if ($request->hasFile('image')) {
            $uploadedImage = $this->cloudinary->upload(
                $request->file('image'),
                'rp-jewellers/products'
            );

            $validated['image'] = $uploadedImage['url'];
            $validated['cloudinary_public_id'] = $uploadedImage['public_id'];
        }

        $product->update($validated);

        // Delete the previous image only after the product is updated.
        if ($request->hasFile('image')) {
            $this->deleteProductImage($oldImage, $oldPublicId);
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $image = $product->image;
        $publicId = $product->cloudinary_public_id;

        $product->delete();

        $this->deleteProductImage($image, $publicId);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * Generate a unique product slug.
     */
    private function generateUniqueSlug(
        string $name,
        ?int $excludeProductId = null
    ): string {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 2;

        while (
            Product::where('slug', $slug)
                ->when(
                    $excludeProductId,
                    fn ($query) => $query->where('id', '!=', $excludeProductId)
                )
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Delete an old product image from Cloudinary or local storage.
     */
    private function deleteProductImage(
        ?string $image,
        ?string $publicId
    ): void {
        if ($publicId) {
            $this->cloudinary->delete($publicId);

            return;
        }

        if ($image && str_starts_with($image, 'products/')) {
            Storage::disk('public')->delete($image);
        }
    }
}
