<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use App\Services\ProductService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
            $this->addProductToCart($user, $request);

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

    public function cart(): View
    {
        $user = $this->userService->getAuthenticatedUser();
        return view('components.cart', [
            'items' => $user->shoppingCart?->items ?? collect([]),
            'total' => $user->shoppingCart?->items->sum(function ($item) {
                return $item->product->price;
            })
        ]);
    }

    private function getId(Request $request): mixed
    {
        $data = $request->all();
        return (int) $data['product_id'];
    }

    /**
     * @throws Exception
     */
    private function getProduct(Request $request, ShoppingCart $shoppingCart): \App\Models\Product
    {
        $request->validate(['product_id' => 'required']);
        $id = $this->getId($request);

        $product = $this->productService->getProductById($id);

        $this->validateProductStock($shoppingCart, $product);

        return $product;
    }

    public function addProductToCart(\App\Models\Guest|\Illuminate\Contracts\Auth\Authenticatable $user, Request $request): void
    {
        $cart = $user->shoppingCart()->firstOrCreate([]);
        $product = $this->getProduct($request, $cart);
        $this->productService->addProductToCart($product, $cart);
    }

    /**
     * @param ShoppingCart $shoppingCart
     * @param \App\Models\Product $product
     * @return void
     * @throws Exception
     */
    public function validateProductStock(ShoppingCart $shoppingCart, \App\Models\Product $product): void
    {
        $ownProduct = $shoppingCart->items()->where('product_id', $product->id)->first();
        if ($ownProduct) {
            throw new Exception('You already added this product to your cart.');
        }

        if ($product->stock < 1) {
            throw new Exception('Oops... Somebody just reserved this product.');
        }
    }
}
