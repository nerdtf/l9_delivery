<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

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

    public function removeFromCart($userId, $productId)
    {
        $this->redis->hDel("cart:$userId", $productId);
    }

    public function getCart($userId)
    {
        return $this->redis->hGetAll("cart:$userId");
    }

    public function clearCart($userId)
    {
        $this->redis->del("cart:$userId");
    }
}
