<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(string $categorySlug, string $productSlug): View
    {
        $id = explode('-', $productSlug)[0];
        $product = $this->getProduct($id);

        return view('pages.product.product', [
            'categoryName' => $product->name,
            'product' => $product
        ]);
    }

    private function getProduct(string $id): \App\Models\Product
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            abort(404); // Redirects to the default 404 page
        }
        return $product;
    }
}
