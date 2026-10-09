<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)
            ->get();

        $products = Product::where('status', 1)
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact('categories', 'products'));
    }
}