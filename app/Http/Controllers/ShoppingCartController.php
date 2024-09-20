<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\UserService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    private UserService $userService;
    private ProductService $productService;

    public function __construct(
        UserService $userService,
        ProductService $productService
    ) {
        $this->userService = $userService;
        $this->productService = $productService;
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $product = $this->getProduct($request);

            $user = $this->userService->getAuthenticatedUser();
            $item = $this->productService->addProductToCart($user, $product);
            if ($item) {
                $product->stock = config('constants.product_status.reserved');
                $product->save();
            }

            return response()->json([
                'message' => 'Product added to cart successfully',
                'cartItems' => $user->shoppingCart->items
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    private function getId(Request $request): mixed
    {
        $data = $request->all();
        return (int) $data['product_id'];
    }

    private function getProduct(Request $request): \App\Models\Product
    {
        $request->validate(['product_id' => 'required']);
        $id = $this->getId($request);
        $product = $this->productService->getProductById($id);

        if ($product->stock < 1) {
            throw new Exception('product-reserved');
        }

        return $product;
    }
}
