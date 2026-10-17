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
                'image' => '1791108924_anklets1.jpg',
            ],
            [
                'name' => 'Diamond',
                'image' => 'diamond.jpg',
            ],
            [
                'name' => 'Polki Jewellery',
                'image' => 'polkhi-jewellary.jpg',
            ],
            [
                'name' => 'Pearls',
                'image' => 'pearls.jpg',
            ],
            [
                'name' => 'Wedding Sets',
                'image' => 'wedding-sets.jpg',
            ],
            [
                'name' => 'Cufflinks',
                'image' => 'cufflinks.jpg',
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
