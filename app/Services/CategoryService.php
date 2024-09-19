<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;

class CategoryService
{
    public function getCategoryIdsBySlugs ()
    {
        $slugs = [
            config('constants.category_slug.womens'),
            config('constants.category_slug.mens'),
            config('constants.category_slug.kids')
        ];

        $categories = Category::whereIn('slug', $slugs)
            ->pluck('id', 'slug');
        return $categories->toArray();
    }
}
