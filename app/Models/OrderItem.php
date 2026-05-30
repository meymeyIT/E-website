<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;


class OrderItem extends Model
{
    // Fillable attributes for mass assignment
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    // Relationship: OrderItem belongs to an Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relationship: OrderItem belongs to a Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
