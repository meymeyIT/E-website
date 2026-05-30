<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'total_price',
        'payment_status',
        'order_status',
    ];

    protected static function booted()
    {
        static::creating(function ($order) {
            $order->uuid = Str::uuid()->toString();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
{
    return $this->hasMany(OrderItem::class);
}

}

