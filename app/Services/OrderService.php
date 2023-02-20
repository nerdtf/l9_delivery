<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function createOrder($clientId, $productIdsAndQuantities)
    {
        $order = DB::transaction(function () use ($clientId, $productIdsAndQuantities) {
            $order = Order::create([
                'client_id' => $clientId,
                'courier_id' => 1,
                'status' => OrderStatus::New
            ]);

            foreach ($productIdsAndQuantities["products"] as $item) {
                $product = Product::findOrFail($item["product_id"]);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'price' => $product->price * $item["quantity"],
                    'quantity' => $item["quantity"],
                ]);
            }
            return $order;
        });
        return $order;
    }
}
