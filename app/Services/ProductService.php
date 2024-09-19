<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function getProductsByCategory(int $categoryId = null, int $int = 10): Collection
    {
        return Product::when($categoryId, function($query) use ($categoryId) {
            $query->where('category_id', $categoryId);
        })
            ->orderBy('id', 'desc')
            ->with('category')
            ->limit($int)
            ->get();
    }
}
