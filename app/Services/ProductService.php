<?php

namespace App\Services;

use App\Models\Guest;
use App\Models\Product;
use App\Models\ShoppingCart;
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

    public function addProductToCart(Product $product, ShoppingCart $cart)
    {
        $cart->items()->create([
            'product_id' => $product->id
        ]);
        $this->updateProductsStockToReserved($product, $cart);
        return $cart;
    }

    private function updateProductsStockToReserved(Product $product, ShoppingCart $cart): void
    {
        $product->stock = config('constants.product_status.reserved');
        $product->save();
        $cart->touch();
    }
}
