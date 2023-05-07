<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductObserver
{
    public function updated(Product $product) {
        // Check if the image field has changed
        if ($product->isDirty('image')) {
            // Delete the old image from storage
            Storage::delete($product->getOriginal('image'));

            // Put the new image in storage
            $product->image->store('product_images');
        }
    }
}
