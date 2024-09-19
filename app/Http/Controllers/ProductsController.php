<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductsController extends Controller
{
    public function category(): View
    {
        return view('pages.product.products');
    }

    public function allProducts(): View
    {
        return view('pages.product.products');
    }
}
