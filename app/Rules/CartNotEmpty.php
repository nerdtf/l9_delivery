<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Services\CartService;

class CartNotEmpty implements Rule
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $userId = auth()->id();
        $cart = $this->cartService->getCart($userId);

        return count($cart) > 0;
    }

    public function message()
    {
        return 'Your cart is empty. Please add at least one product to the cart before placing an order.';
    }
}
