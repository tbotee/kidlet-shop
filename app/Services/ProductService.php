<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class ProductService
{
    public function getProducts(int $categoryId = null, int $limit = 10): Collection
    {
        $builder = $this->getProductsBuilder($categoryId);
        return $builder->limit($limit)->get();
    }

    public function getProductsWithPagination(int $categoryId = null, int $limit = 10): Paginator
    {
        $builder = $this->getProductsBuilder($categoryId);
        return $builder->paginate($limit);
    }

    private function getProductsBuilder(int $categoryId = null): Builder
    {
        return Product::when($categoryId, function($query) use ($categoryId) {
            $query->where('category_id', $categoryId);
        })
            ->orderBy('created_at', 'desc')
            ->with('category');
    }


}
