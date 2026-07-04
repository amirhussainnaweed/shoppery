<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class order extends Model
{
        use HasFactory;
    protected $fillable = [
        'user_id',
        'billing_id',
        'shipping_address_id',
        'order_date',
        'status',
        'payment_method',
        'shipping_cost',
        'total_price'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Billing(){
        return $this->belongsTo(Billing::class);
    }

    public function ShippingAddress(){
        return $this->belongsTo(ShippingAddress::class);
    }

    public function OrderItem(){
        return $this->hasMany(OrderItem::class);
    }


}
