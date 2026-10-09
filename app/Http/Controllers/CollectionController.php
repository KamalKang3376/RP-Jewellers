<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CollectionController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();

        return view('collections', compact('categories'));
    }
}