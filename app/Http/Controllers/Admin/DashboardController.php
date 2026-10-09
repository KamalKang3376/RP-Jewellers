<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();

        $totalCategories = Category::where('status', 1)->count();

        $totalOrders = Order::count();

        $totalCustomers = User::where('role', 'customer')->count();

        $recentOrders = Order::latest('created_at')
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalProducts',
            'totalCategories',
            'totalOrders',
            'totalCustomers',
            'recentOrders'
        ));
    }
}