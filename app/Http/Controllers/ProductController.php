<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->latest()
            ->take(4)
            ->get();

        $isWishlisted = false;

        if (Auth::check()) {
            $isWishlisted = Wishlist::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->exists();
        }

        return view('product', compact(
            'product',
            'relatedProducts',
            'isWishlisted'
        ));
    }
}