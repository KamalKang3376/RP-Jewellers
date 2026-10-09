<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
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

        $validated['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time() . '_' . $image->getClientOriginalName();

            $image->move(
                public_path('images/products'),
                $imageName
            );

            $validated['image'] = $imageName;
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

        $validated['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {

            if (
                $product->image &&
                file_exists(
                    public_path('images/products/' . $product->image)
                )
            ) {
                unlink(
                    public_path('images/products/' . $product->image)
                );
            }

            $image = $request->file('image');

            $imageName = time() . '_' . $image->getClientOriginalName();

            $image->move(
                public_path('images/products'),
                $imageName
            );

            $validated['image'] = $imageName;
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if (
            $product->image &&
            file_exists(
                public_path('images/products/' . $product->image)
            )
        ) {
            unlink(
                public_path('images/products/' . $product->image)
            );
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}