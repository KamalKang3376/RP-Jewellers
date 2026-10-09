<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shipping = $subtotal >= 5000 ? 0 : 100;

        $total = $subtotal + $shipping;

        return view('checkout', compact(
            'cart',
            'subtotal',
            'shipping',
            'total'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'payment_method' => 'required|in:cod,online',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shipping = $subtotal >= 5000 ? 0 : 100;

        $total = $subtotal + $shipping;

        DB::beginTransaction();

        try {

           $order = Order::create([
                'order_number' => 'RP-' . strtoupper(uniqid()),
                'user_id' => Auth::id(),

                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->pincode,

                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total' => $total,

                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'status' => 'pending',
            ]);

            foreach ($cart as $item) {

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['price'] * $item['quantity'],
            ]);
            }

            DB::commit();

            session()->forget('cart');

            return redirect()
                ->route('order.success', $order->id)
                ->with('success', 'Your order has been placed successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Something went wrong while placing your order: ' . $e->getMessage());
        }
    }

    public function success($id)
    {
        $order = Order::findOrFail($id);

        return view('order-success', compact('order'));
    }
}