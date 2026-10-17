<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Rings',
                'image' => 'rings.jpg',
            ],
            [
                'name' => 'Necklaces',
                'image' => 'necklaces.jpg',
            ],
            [
                'name' => 'Earrings',
                'image' => 'earrings.jpg',
            ],
            [
                'name' => 'Bracelets',
                'image' => 'bracelets.jpg',
            ],
            [
                'name' => 'Pendants',
                'image' => 'pendants.jpg',
            ],
            [
                'name' => 'Bangles',
                'image' => 'bangles.jpg',
            ],
            [
                'name' => 'Anklets',
                'image' => 'anklets.jpg',
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::updateOrCreate(
                ['name' => $categoryData['name']],
                [
                    'slug' => Str::slug($categoryData['name']),
                    'image' => $categoryData['image'],
                    'status' => 1,
                ]
            );
        }
    }
}
