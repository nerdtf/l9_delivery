<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderService
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function createOrder($clientId, $productIdsAndQuantities)
    {
        $order = DB::transaction(function () use ($clientId, $productIdsAndQuantities) {
            $order = Order::create([
                'client_id' => $clientId,
                'courier_id' => 1,
                'status' => OrderStatus::New
            ]);

            foreach ($productIdsAndQuantities as $product_id => $quantity) {
                $product = Product::findOrFail($product_id);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'price' => $product->price * $quantity,
                    'quantity' => $quantity,
                ]);
            }
            return $order;
        });

        $this->cartService->clearCart($clientId);
        return $order;
    }
}
