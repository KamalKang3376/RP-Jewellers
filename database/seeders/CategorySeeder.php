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
            'Rings',
            'Necklaces',
            'Earrings',
            'Bracelets',
            'Pendants',
            'Bangles',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(
                ['name' => $name],
                [
                    'slug' => Str::slug($name),
                    'status' => 1,
                ]
            );
        }
    }
}
