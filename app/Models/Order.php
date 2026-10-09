<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    'order_number',
    'user_id',
    'name',
    'email',
    'phone',
    'address',
    'city',
    'state',
    'pincode',
    'subtotal',
    'shipping',
    'total',
    'payment_method',
    'payment_status',
    'status',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}