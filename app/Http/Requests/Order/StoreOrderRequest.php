<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\CartService;
use App\Rules\CartNotEmpty;

class StoreOrderRequest extends FormRequest
{

    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
        parent::__construct();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cart' => [new CartNotEmpty($this->cartService)],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cart' => $this->cartService->getCart(auth('client')->user()->id),
        ]);
    }


}
