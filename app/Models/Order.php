<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ["client_id", "courier_id", "status"];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function courier()
    {
        return $this->hasOne(Courier::class, 'id', 'courier_id');
    }

    public function getTotalPriceAttribute()
    {
        return $this->items->sum('price');
    }
}
