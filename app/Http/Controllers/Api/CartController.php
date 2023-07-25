<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Cart\UpdateRequest;
use App\Services\CartService;
use App\Http\Resources\Cart\CartResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(Request $request)
    {
        $showNames = $request->query("showNamesAndPrices", false) === 'true';
        $userId = auth()->id();
        $cart = $this->cartService->getCart($userId, $showNames);
        return new CartResource($cart);
    }

    public function update(UpdateRequest $request)
    {
        $userId = auth()->id();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $this->cartService->addToCart($userId, $productId, $quantity);
        return new CartResource($this->cartService->getCart($userId));
    }

    public function destroy($productId, Request $request)
    {
        $userId = auth()->id();
        $deleteWholeProduct = $request->query('delete_whole_product', false) === 'true';
        $this->cartService->removeFromCart($userId, $productId, $deleteWholeProduct);
        return new CartResource($this->cartService->getCart($userId));
    }
}
