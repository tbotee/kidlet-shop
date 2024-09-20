<?php

namespace App\View\Components;

use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class LatestProductList extends Component
{

    public string $title;
    public string $slug;
    public Collection $products;
    private ProductService $productService;
    private CategoryService $categoryService;

    public function __construct(
        ProductService $productService,
        CategoryService $categoryService,
        string $title,
        string $slug
    ) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->title = $title;
        $this->slug = $slug;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $categoryIdsBySlug = $this->categoryService->getCategoryIdsBySlugs();
        $this->products =  $this->productService->getProducts($categoryIdsBySlug[$this->slug]);

        return view('components.latest-product-list');
    }
}
