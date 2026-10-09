<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $category = $request->input('category');

        $priceRange = $request->input('price_range');

        $sort = $request->input('sort', 'newest');


        $categories = Category::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();


        $products = Product::where('status', 1);


        if ($search) {

            $products->where(function ($query) use ($search) {

                $query->where(
                    'name',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'description',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhereHas('category', function ($categoryQuery) use ($search) {

                    $categoryQuery->where(
                        'name',
                        'like',
                        '%' . $search . '%'
                    );

                });

            });

        }


        if ($category) {

            $products->whereHas('category', function ($query) use ($category) {

                $query->where('slug', $category);

            });

        }


        if ($priceRange == '0-10000') {

            $products->where(function ($query) {

                $query->where(function ($q) {

                    $q->whereNotNull('discount_price')
                        ->where('discount_price', '<=', 10000);

                })

                ->orWhere(function ($q) {

                    $q->whereNull('discount_price')
                        ->where('price', '<=', 10000);

                });

            });

        }


        elseif ($priceRange == '10000-25000') {

            $products->where(function ($query) {

                $query->where(function ($q) {

                    $q->whereNotNull('discount_price')
                        ->whereBetween(
                            'discount_price',
                            [10000, 25000]
                        );

                })

                ->orWhere(function ($q) {

                    $q->whereNull('discount_price')
                        ->whereBetween(
                            'price',
                            [10000, 25000]
                        );

                });

            });

        }


        elseif ($priceRange == '25000+') {

            $products->where(function ($query) {

                $query->where(function ($q) {

                    $q->whereNotNull('discount_price')
                        ->where('discount_price', '>', 25000);

                })

                ->orWhere(function ($q) {

                    $q->whereNull('discount_price')
                        ->where('price', '>', 25000);

                });

            });

        }


        if ($sort == 'price_low') {

            $products->orderByRaw(
                'COALESCE(discount_price, price) ASC'
            );

        }

        elseif ($sort == 'price_high') {

            $products->orderByRaw(
                'COALESCE(discount_price, price) DESC'
            );

        }

        elseif ($sort == 'name') {

            $products->orderBy('name', 'asc');

        }

        else {

            $products->orderBy('id', 'desc');

        }


        $products = $products->get();


        $wishlistProductIds = [];


        if (Auth::check()) {

            $wishlistProductIds = Wishlist::where(
                'user_id',
                Auth::id()
            )
            ->pluck('product_id')
            ->toArray();

        }


        return view(
            'shop',
            compact(
                'products',
                'categories',
                'search',
                'category',
                'priceRange',
                'sort',
                'wishlistProductIds'
            )
        );
    }
}