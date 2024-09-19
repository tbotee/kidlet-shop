<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    private ProductService $productService;
    private CategoryService $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index(): View
    {
        $categoryIdsBySlug = $this->categoryService->getCategoryIdsBySlugs();
        return view('pages.welcome', [
            'womens' => $this->productService->getProductsByCategory(
                $categoryIdsBySlug[config('constants.category_slug.womens')]
            ),
            'mens' => $this->productService->getProductsByCategory(
                $categoryIdsBySlug[config('constants.category_slug.mens')]
            ),
            'kids' => $this->productService->getProductsByCategory(
                $categoryIdsBySlug[config('constants.category_slug.kids')]
            )
        ]);
    }
}
