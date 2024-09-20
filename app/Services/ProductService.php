<?php

namespace App\Services;

use App\Models\Guest;
use App\Models\Product;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Exception;

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

    public function getProductById(int $id): Product
    {
        return Product::with('category')->findOrFail($id);
    }

    private function getProductsBuilder(int $categoryId = null): Builder
    {
        return Product::when($categoryId, function($query) use ($categoryId) {
            $query->where('category_id', $categoryId);
        })
            ->whereIn('stock', [
                config('constants.product_status.in_stock'),
                config('constants.product_status.reserved'),
            ])
            ->orderBy('created_at', 'desc')
            ->with('category');
    }

    public function addProductToCart(Guest|Authenticatable $user, Product $product)
    {
        $cart = $user->shoppingCart()->firstOrCreate([]);
        $cartItem = $cart->items()->where('product_id', $product->id)->first();
        if (!$cartItem) {
            return $cart->items()->create([
                'product_id' => $product->id
            ]);
        } else {
            throw new Exception('product-reserved-by-current-user');
        }
    }
}
