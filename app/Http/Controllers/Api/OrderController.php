<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Resources\Orders\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function __construct(
        private readonly OrderService $orderService
    ) {}


    public function index()
    {
        return  OrderResource::collection(auth()->user()->orders()->get());
    }

    public function show($orderId)
    {
        $order = Order::findOrFail($orderId);
        $this->authorize('view', $order);
        return new OrderResource($order);
    }

    public function store(StoreOrderRequest $request)
    {
        return new OrderResource(
            $this->orderService->createOrder(auth()->id(), $request->validated())
        );
    }

//    public function destroy()
//    {
//
//    }

}
