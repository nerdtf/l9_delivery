<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductService
{
        public function update(Product $product, $attributes)
        {
            DB::beginTransaction();
            try {
                $product->update($attributes);
            }
            catch (\Exception $e) {
                DB::rollBack();
                Log::error(Auth::id() . ' | ' . $e->getMessage());
                throw new \RuntimeException($e->getMessage());
            }
            return Product::where('id', $product->id)->first();
        }
}
