<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $products = [];

        foreach ($this->resource as $key => $value) {
            $products[] = [
                'product_id' => $key,
                'quantity' => (int)$value,
            ];
        }

        return [
            'products' => $products,
        ];
    }
}
