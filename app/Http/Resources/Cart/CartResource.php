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
            $product = [
                'product_id' => $key,
                'quantity' => is_array($value) ? (int)$value['quantity'] : (int)$value,
            ];
            if (is_array($value) && isset($value['name'])) {
                $product['product_name'] = $value['name'];
                if (isset($value['price'])) {
                    $product['product_price'] = $value['price'];
                }
            }
            $products[] = $product;
        }

        return [
            'products' => $products,
        ];
    }
}
