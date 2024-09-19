<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BannerCategory extends Component
{
    public Category $category;

    /**
     * Create a new component instance.
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.banner-category');
    }
}
