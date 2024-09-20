<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\View\View;

class ProductsController extends Controller
{
    private ProductService $productService;
    private CategoryService $categoryService;
    private array $categoryIdsBySlug;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->categoryIdsBySlug = $this->categoryService->getCategoryIdsBySlugs();
    }

    public function category(string $categorySlug): View
    {
        return view('pages.product.products', [
            'products' => $this->productService->getProductsWithPagination($this->categoryIdsBySlug[$categorySlug], 9),
            'categoryName' => Category::find($this->categoryIdsBySlug[$categorySlug])->name
        ]);
    }

    public function allProducts(): View
    {
        return view('pages.product.products', [
            'products' => $this->productService->getProductsWithPagination(limit: 9),
            'categoryName' => 'All Our'
        ]);
    }
}
