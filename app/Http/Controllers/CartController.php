<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        foreach ($cart as $key => $item) {

            if (!isset($item['id'])) {

                if (isset($item['product_id'])) {
                    $cart[$key]['id'] = $item['product_id'];
                } else {
                    $cart[$key]['id'] = $key;
                }
            }
        }

        session()->put('cart', $cart);

        return view('cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock <= 0) {
            return back()->with('error', 'This product is out of stock.');
        }

        if ($request->quantity > $product->stock) {
            return back()->with('error', 'Requested quantity is not available.');
        }

        $cart = session()->get('cart', []);

        $productId = $product->id;

        if (isset($cart[$productId])) {

            $currentQuantity = $cart[$productId]['quantity'] ?? 0;

            $newQuantity = $currentQuantity + $request->quantity;

            if ($newQuantity > $product->stock) {
                return back()->with('error', 'Not enough stock available.');
            }

            $cart[$productId]['id'] = $product->id;
            $cart[$productId]['name'] = $product->name;
            $cart[$productId]['price'] = $product->discount_price ?? $product->price;
            $cart[$productId]['image'] = $product->image;
            $cart[$productId]['quantity'] = $newQuantity;

        } else {

            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->discount_price ?? $product->price,
                'image' => $product->image,
                'quantity' => $request->quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Product added to cart successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return back()->with('error', 'Product not found in cart.');
        }

        $product = Product::find($id);

        if (!$product) {
            return back()->with('error', 'Product not found.');
        }

        if ($request->quantity > $product->stock) {
            return back()->with('error', 'Requested quantity is not available.');
        }

        $cart[$id]['id'] = $product->id;
        $cart[$id]['quantity'] = $request->quantity;

        session()->put('cart', $cart);

        return back()->with('success', 'Cart updated successfully.');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Product removed from cart.');
    }

    public function clear()
    {
        session()->forget('cart');

        return back()->with('success', 'Cart cleared successfully.');
    }
}