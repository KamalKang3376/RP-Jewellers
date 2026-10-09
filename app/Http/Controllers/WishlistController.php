<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('wishlist', compact('wishlists'));
    }

    public function toggle($productId)
    {
        $product = Product::findOrFail($productId);

        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($wishlist) {

            $wishlist->delete();

            return response()->json([
                'status' => 'removed'
            ]);
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        return response()->json([
            'status' => 'added'
        ]);
    }

    public function remove($productId)
    {
        Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->delete();

        return back()->with('success', 'Product removed from wishlist.');
    }
}