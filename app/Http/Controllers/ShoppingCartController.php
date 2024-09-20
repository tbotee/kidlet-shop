<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
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
            $user = $this->userService->getAuthenticatedUser();
            $cart = $user->shoppingCart()->firstOrCreate([]);
            $product = $this->getProduct($request, $cart);

            $item = $this->productService->addProductToCart($product, $cart);

            if ($item) {
                $product->stock = config('constants.product_status.reserved');
                $product->save();
                $cart->touch();
            }

            return response()->json([
                'message' => 'Product added to cart successfully',
                'cartItems' => $user->shoppingCart->items->count()
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

    private function getProduct(Request $request, ShoppingCart $shoppingCart): \App\Models\Product
    {
        $request->validate(['product_id' => 'required']);
        $id = $this->getId($request);

        $product = $this->productService->getProductById($id);

        $ownProduct = $shoppingCart->items()->where('product_id', $product->id)->first();
        if ($ownProduct) {
            throw new Exception('You already added this product to your cart.');
        }

        if ($product->stock < 1) {
            throw new Exception('Oops... Somebody just reserved this product.');
        }

        return $product;
    }
}
