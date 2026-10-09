<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [

            [
                'category_id' => 1,
                'name' => 'Diamond Solitaire Ring',
                'price' => 24999,
                'discount_price' => 21999,
                'description' => 'A timeless diamond solitaire ring crafted with elegance.',
                'image' => 'diamond-ring.jpg',
                'stock' => 10,
            ],

            [
                'category_id' => 1,
                'name' => 'Classic Gold Ring',
                'price' => 18999,
                'discount_price' => 16999,
                'description' => 'A classic gold ring with a sophisticated design.',
                'image' => 'gold-ring.jpg',
                'stock' => 15,
            ],

            [
                'category_id' => 2,
                'name' => 'Emerald Necklace',
                'price' => 42999,
                'discount_price' => 39999,
                'description' => 'An elegant emerald necklace designed for special occasions.',
                'image' => 'emerald-necklace.jpg',
                'stock' => 8,
            ],

            [
                'category_id' => 2,
                'name' => 'Pearl Necklace',
                'price' => 29999,
                'discount_price' => 26999,
                'description' => 'A graceful pearl necklace with a timeless appearance.',
                'image' => 'pearl-necklace.jpg',
                'stock' => 12,
            ],

            [
                'category_id' => 3,
                'name' => 'Diamond Earrings',
                'price' => 22999,
                'discount_price' => 19999,
                'description' => 'Elegant diamond earrings for a sophisticated look.',
                'image' => 'diamond-earrings.jpg',
                'stock' => 10,
            ],

            [
                'category_id' => 3,
                'name' => 'Gold Earrings',
                'price' => 15999,
                'discount_price' => 13999,
                'description' => 'Beautiful gold earrings with a classic finish.',
                'image' => 'gold-earrings.jpg',
                'stock' => 20,
            ],

            [
                'category_id' => 4,
                'name' => 'Gold Bracelet',
                'price' => 34999,
                'discount_price' => 31999,
                'description' => 'A beautiful gold bracelet crafted for everyday elegance.',
                'image' => 'gold-bracelet.jpg',
                'stock' => 7,
            ],

            [
                'category_id' => 5,
                'name' => 'Diamond Pendant',
                'price' => 19999,
                'discount_price' => 17999,
                'description' => 'A delicate diamond pendant with an elegant design.',
                'image' => 'diamond-pendant.jpg',
                'stock' => 14,
            ],

            [
                'category_id' => 6,
                'name' => 'Traditional Gold Bangles',
                'price' => 38999,
                'discount_price' => 35999,
                'description' => 'Traditional gold bangles designed for celebrations.',
                'image' => 'gold-bangles.jpg',
                'stock' => 6,
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'category_id' => $product['category_id'],
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => $product['description'],
                'price' => $product['price'],
                'discount_price' => $product['discount_price'],
                'image' => $product['image'],
                'stock' => $product['stock'],
                'status' => 1,
            ]);
        }
    }
}