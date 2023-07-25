<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;
use App\Models\Product;

class CartService {
    protected $redis;

    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    public function addToCart($userId, $productId, $quantity)
    {
        $currentQuantity = $this->redis->hGet("cart:$userId", $productId);
        $newQuantity = $currentQuantity ? ((int)$currentQuantity + $quantity) : $quantity;
        $this->redis->hSet("cart:$userId", $productId, $newQuantity);
    }

    public function removeFromCart($userId, $productId, $deleteWholeProductFromCart)
    {
        if ($deleteWholeProductFromCart){
            $this->redis->hDel("cart:$userId", $productId);
        }
        else{
            $this->addToCart($userId, $productId, -1);
        }
    }

    public function getCart($userId, $showNames = false)
    {
        $cart = $this->redis->hGetAll("cart:$userId");

        if ($showNames) {
            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)->get();
            $productNames = $products->pluck('name', 'id')->toArray();
            $productPrices= $products->pluck('price', 'id')->toArray();
            foreach ($cart as $productId => &$quantity) {
                $productName = $productNames[$productId] ?? null;
                $productPrice = $productPrices[$productId] ?? null;
                $quantity = [
                    'quantity' => $quantity,
                    'name' => $productName,
                    'price' => $productPrice,
                ];
            }

        }
        return $cart;
    }

    public function clearCart($userId)
    {
        $this->redis->del("cart:$userId");
    }
}
