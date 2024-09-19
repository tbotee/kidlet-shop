<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    private array $categories = [
        [
            'name' => "Women's",
            'slug' => 'womens',
            'in_home_banner' => true,
            'in_menu' => true,
            'order' => 1,
            'image_path' => 'assets/images/baner-right-image-01.jpg'
        ],

        [
            'name' => "Men's",
            'slug' => 'mens',
            'in_home_banner' => true,
            'in_menu' => true,
            'order' => 2,
            'image_path' => 'assets/images/baner-right-image-02.jpg'
        ],
        [
            'name' => "Kid's",
            'slug' => 'kids',
            'in_home_banner' => true,
            'in_menu' => true,
            'order' => 3,
            'image_path' => 'assets/images/baner-right-image-03.jpg'
        ],
        [
            'name' => "Accessories",
            'slug' => 'accessories',
            'in_home_banner' => true,
            'in_menu' => false,
            'order' => 4,
            'image_path' => 'assets/images/baner-right-image-04.jpg'
        ],
        [
            'name' => "On Sale",
            'slug' => 'on-sale',
            'in_home_banner' => false,
            'in_menu' => false,
            'order' => 5
        ]
    ];

    function run(): void
    {
        foreach ($this->categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']], // Unique key to identify existing records
                $category
            );
        }
    }
}
