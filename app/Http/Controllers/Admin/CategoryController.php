<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
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

    $validated['slug'] = Str::slug($request->name);

    if ($request->hasFile('image')) {

        $image = $request->file('image');

        $imageName = time() . '_' . $image->getClientOriginalName();

        $image->move(
            public_path('images/categories'),
            $imageName
        );

        $validated['image'] = $imageName;
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

    $validated['slug'] = Str::slug($request->name);

    if ($request->hasFile('image')) {

        $image = $request->file('image');

        $imageName = time() . '_' . $image->getClientOriginalName();

        $image->move(
            public_path('images/categories'),
            $imageName
        );

        $validated['image'] = $imageName;
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

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    
}