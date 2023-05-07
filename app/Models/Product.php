<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ["name", "description", "image", "weight", "price"];

    public function getImageAttribute($value)
    {
        if ($value) {
            return url(Storage::disk('public')->url('product_images/' . $value));
        }

        return null;
    }

}
