<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Resources\Orders\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use App\Services\CartService;

class OrderController extends Controller
{
    protected $orderService;
    protected $cartService;

    public function __construct(OrderService $orderService, CartService $cartService)
    {
        $this->orderService = $orderService;
        $this->cartService = $cartService;
    }


    public function index()
    {
        return  OrderResource::collection(auth()->user()->orders()->with('items.product')->get());
    }

    public function show($orderId)
    {
        $order = Order::findOrFail($orderId);
        $this->authorize('view', $order);
        return new OrderResource($order);
    }

    public function store(StoreOrderRequest $request)
    {
        $clientId = auth()->id();
        $cartData = $this->cartService->getCart($clientId);
        return new OrderResource(
            $this->orderService->createOrder($clientId, $cartData)
        );
    }


}
