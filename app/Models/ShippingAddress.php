<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingAddress extends Model
{
        use HasFactory;
   protected $fillable =[
    'user_id',
    'text',
    'city',
    'country',
    'postal_code'
   ];

   public function users(){
    return $this->belongsToMany(User::class);
   }

   public function orders(){
    return $this->hasMany(Order::class);
   }
}
