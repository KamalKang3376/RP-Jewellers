<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'category' => 'Rings',
                'name' => 'Diamond Solitaire Ring',
                'price' => 24999,
                'discount_price' => 21999,
                'description' => 'A timeless diamond solitaire ring crafted with elegance.',
                'image' => 'diamond-ring.jpg',
                'stock' => 10,
            ],
            [
                'category' => 'Rings',
                'name' => 'Classic Gold Ring',
                'price' => 18999,
                'discount_price' => 16999,
                'description' => 'A classic gold ring with a sophisticated design.',
                'image' => 'gold-ring.jpg',
                'stock' => 15,
            ],
            [
                'category' => 'Necklaces',
                'name' => 'Emerald Necklace',
                'price' => 42999,
                'discount_price' => 39999,
                'description' => 'An elegant emerald necklace designed for special occasions.',
                'image' => 'emerald-necklace.jpg',
                'stock' => 8,
            ],
            [
                'category' => 'Necklaces',
                'name' => 'Pearl Necklace',
                'price' => 29999,
                'discount_price' => 26999,
                'description' => 'A graceful pearl necklace with a timeless appearance.',
                'image' => 'pearl-necklace.jpg',
                'stock' => 12,
            ],
            [
                'category' => 'Earrings',
                'name' => 'Diamond Earrings',
                'price' => 22999,
                'discount_price' => 19999,
                'description' => 'Elegant diamond earrings for a sophisticated look.',
                'image' => 'diamond-earrings.jpg',
                'stock' => 10,
            ],
            [
                'category' => 'Earrings',
                'name' => 'Gold Earrings',
                'price' => 15999,
                'discount_price' => 13999,
                'description' => 'Beautiful gold earrings with a classic finish.',
                'image' => 'gold-earrings.jpg',
                'stock' => 20,
            ],
            [
                'category' => 'Bracelets',
                'name' => 'Gold Bracelet',
                'price' => 34999,
                'discount_price' => 31999,
                'description' => 'A beautiful gold bracelet crafted for everyday elegance.',
                'image' => 'gold-bracelet.jpg',
                'stock' => 7,
            ],
            [
                'category' => 'Pendants',
                'name' => 'Diamond Pendant',
                'price' => 19999,
                'discount_price' => 17999,
                'description' => 'A delicate diamond pendant with an elegant design.',
                'image' => 'diamond-pendant.jpg',
                'stock' => 14,
            ],
            [
                'category' => 'Bangles',
                'name' => 'Traditional Gold Bangles',
                'price' => 38999,
                'discount_price' => 35999,
                'description' => 'Traditional gold bangles designed for celebrations.',
                'image' => 'gold-bangles.jpg',
                'stock' => 6,
            ],
        ];

        foreach ($products as $data) {
            $category = Category::where('name', $data['category'])->first();

            if (!$category) {
                throw new \RuntimeException(
                    'Category not found: ' . $data['category']
                );
            }

            Product::updateOrCreate(
                ['slug' => Str::slug($data['name'])],
                [
                    'category_id' => $category->id,
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'discount_price' => $data['discount_price'],
                    'image' => $data['image'],
                    'stock' => $data['stock'],
                    'status' => 1,
                ]
            );
        }
    }
}
