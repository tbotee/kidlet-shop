<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\Services\ProductService;
use App\Services\UserService;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShoppingCartController extends Controller
{
    public function __construct(
        public UserService $userService,
        public ProductService $productService
    ) {
    }

    public function store(Request $request): JsonResponse
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

    public function remove(int $productId): JsonResponse
    {
        try {
            $user = $this->userService->getAuthenticatedUser();
            $this->removeProductFromCart($user, $productId);

            return response()->json([
                'message' => 'Product successfully removed from the cart',
                'cartItems' => $user->shoppingCart->items->count()
            ], 200);
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

    public function checkout(): View
    {
        try {
            $user = $this->userService->getAuthenticatedUser();
            $this->productService->checkout($user->shoppingCart);
            return view('pages.checkout', [
                'categoryName' => 'You checked out successfully!'
            ]);
        } catch (Exception $e) {
            abort(404);
        }
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

    /**
     * @throws Exception
     */
    public function addProductToCart(Guest|Authenticatable $user, Request $request): void
    {
        $cart = $user->shoppingCart()->firstOrCreate([]);
        $product = $this->getProduct($request, $cart);
        $this->productService->addProductToCart($product, $cart);
    }

    public function removeProductFromCart(Guest|Authenticatable $user, int $productId): void
    {
        $cart = $user->shoppingCart;
        $product = $this->productService->getProductById($productId);
        $this->productService->removeProductToCart($product, $cart);
    }

    /**
     * @throws Exception
     */
    public function validateProductStock(ShoppingCart $shoppingCart, Product $product): void
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
