<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getProductsByCategory(int $categoryId = null, int $int = 10)
    {
        return Product::when($categoryId, function($query) use ($categoryId) {
            $query->where('category_id', $categoryId);
        })
            ->orderBy('id', 'desc')
            ->with('category')
            ->limit($int);
    }
}
