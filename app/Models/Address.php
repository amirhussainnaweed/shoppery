<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model

{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'address_text',
        'city',
        'country',
        'postal_code'
    ];

    public function User(){
        return $this->belongsToMany(User::class);
    }

    public function Billing(){
        return $this->hasMany(Billing::class);
    }
}
